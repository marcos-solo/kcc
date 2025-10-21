<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Session;
use App\Services\BrevoMailService;

class MemberController extends Controller
{
    public function create()
    {
        return view('membership.create');
    }

    // ✅ Step 1: Send OTP via Brevo API
    public function sendOtp(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'email' => 'required|email|unique:tbl_member,email',
            'phone' => 'required|string|max:20',
            'county' => 'required|string|max:200',
            'thematicgroup' => 'required|string',
        ]);

        $otp = rand(100000, 999999);
        Session::put('member_data', $validated);
        Session::put('member_otp', $otp);

        $subject = 'KCCWG Membership Email Verification';
        $body = "
            <h2>Welcome to KCCWG!</h2>
            <p>Your verification code is:</p>
            <h1 style='font-size:24px; color:#2f855a;'>{$otp}</h1>
            <p>Enter this code on the verification page to complete your registration.</p>
        ";

        try {
            BrevoMailService::sendMail($validated['email'], $subject, $body);
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);
        $storedOtp = Session::get('member_otp');
        $memberData = Session::get('member_data');

        if ($storedOtp && $request->otp == $storedOtp) {
            // Save new member
            $member = Member::create($memberData);

            // Clear session data
            Session::forget(['member_data', 'member_otp']);

            // ✅ Send confirmation email with KCCWG branding
            $subject = "🎉 Welcome to KCCWG, {$member->name}!";

            $body = '
            <div style="background-color:#f4f9f4; padding:40px 0; font-family:Arial, sans-serif;">
            <div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
                
        `    <div style="background-color:#2f855a; color:#ffffff; padding:20px; text-align:center;">
            <img src="' . asset('images/kcclogo.jpeg') . '" alt="KCCWG Logo" style="height:70px; margin-bottom:10px;">
            <h2 style="margin:0;">Kenya Climate Change Working Group</h2>
            </div>
`
                
                <div style="padding:30px; color:#333;">
                <h2 style="color:#2f855a; margin-bottom:15px;">Membership Confirmed 🎉</h2>
                <p>Dear <strong>' . e($member->name) . '</strong>,</p>
                <p>We are delighted to welcome you to the <strong>Kenya Climate Change Working Group (KCCWG)</strong> community!</p>
                
                <p>Your membership has been successfully registered with the following details:</p>
                <table style="width:100%; border-collapse:collapse; margin:15px 0;">
                    <tr>
                    <td style="padding:8px; border-bottom:1px solid #ddd;"><strong>Organization:</strong></td>
                    <td style="padding:8px; border-bottom:1px solid #ddd;">' . e($member->organization) . '</td>
                    </tr>
                    <tr>
                    <td style="padding:8px; border-bottom:1px solid #ddd;"><strong>County:</strong></td>
                    <td style="padding:8px; border-bottom:1px solid #ddd;">' . e($member->county) . '</td>
                    </tr>
                    <tr>
                    <td style="padding:8px; border-bottom:1px solid #ddd;"><strong>Thematic Group:</strong></td>
                    <td style="padding:8px; border-bottom:1px solid #ddd;">' . e($member->thematicgroup) . '</td>
                    </tr>
                </table>

                <p>We’ll keep you informed about upcoming events, projects, and climate initiatives led by KCCWG.</p>
                <p style="margin-top:20px;">Thank you for joining our mission towards a sustainable and climate-resilient Kenya.</p>

                <p style="margin-top:30px; font-size:14px; color:#555;">
                    Warm regards,<br>
                    <strong>KCCWG Membership Team</strong><br>
                    <a href="https://kccwg.org" target="_blank" style="color:#2f855a; text-decoration:none;">www.kccwg.org</a>
                </p>
                </div>

                <div style="background-color:#f0f0f0; text-align:center; padding:15px; font-size:13px; color:#777;">
                © ' . date('Y') . ' Kenya Climate Change Working Group. All rights reserved.
                </div>
            </div>
            </div>';

            try {
                \App\Services\BrevoMailService::sendMail($member->email, $subject, $body);
            } catch (\Exception $e) {
                \Log::error('Failed to send membership confirmation: ' . $e->getMessage());
            }

            return response()->json([
                'status' => 'verified',
                'redirect' => route('membership.thankyou'),
            ]);
        }

        return response()->json(['status' => 'failed', 'message' => 'Invalid OTP.']);
    }


    // ✅ Step 3: Resend OTP
    public function resendOtp()
    {
        $memberData = Session::get('member_data');
        if (!$memberData) {
            return response()->json(['status' => 'error', 'message' => 'Session expired. Please re-register.']);
        }

        $otp = rand(100000, 999999);
        Session::put('member_otp', $otp);

        $subject = 'KCCWG Membership OTP Resend';
        $body = "<p>Your new verification code is:</p><h1>{$otp}</h1>";

        BrevoMailService::sendMail($memberData['email'], $subject, $body);

        return response()->json(['status' => 'resent']);
    }

    public function thankYou()
    {
        return view('membership.thankyou');
    }
}
