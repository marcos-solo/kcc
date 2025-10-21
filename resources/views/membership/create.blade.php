@extends('layouts.app')

@section('title', 'Join as a Member')

@section('content')
<div 
    x-data="membershipForm()" 
    class="max-w-3xl mx-auto py-16 px-4"
>
  <div class="bg-white rounded-2xl shadow-lg p-8 relative overflow-hidden">

    <!-- 🌱 Loader -->
    <div x-show="loading" class="absolute inset-0 bg-white/80 backdrop-blur flex flex-col items-center justify-center z-50">
        <div class="animate-spin rounded-full h-12 w-12 border-4 border-green-600 border-t-transparent mb-4"></div>
        <p class="text-green-700 font-semibold" x-text="loadingText"></p>
    </div>

    <h1 class="text-3xl font-bold text-green-700 mb-4">Become a Member</h1>
    <p class="text-gray-600 mb-6">Fill in your details to register and verify your email.</p>

    <!-- 🧾 Form -->
    <form @submit.prevent="submitForm" class="space-y-4">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><input type="text" placeholder="Full Name" x-model="form.name" required class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500 shadow-sm mt-1 p-2.5"></div>
        <div><input type="text" placeholder="Organization" x-model="form.organization" required class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500 shadow-sm mt-1 p-2.5"></div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><input type="email" placeholder="Email" x-model="form.email" required class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500 shadow-sm mt-1 p-2.5"></div>
        <div><input type="text" placeholder="Phone" x-model="form.phone" required class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500 shadow-sm mt-1 p-2.5"></div>
      </div>
      <div><input type="text" placeholder="County" x-model="form.county" required class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500 shadow-sm mt-1 p-2.5"></div>
      <div><textarea placeholder="Thematic Group" x-model="form.thematicgroup" rows="3" required class="w-full rounded-xl border-gray-200 focus:ring-green-500 focus:border-green-500 shadow-sm mt-1 p-2.5"></textarea></div>

      <div class="flex justify-end mt-6">
        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 shadow transition">Register</button>
      </div>
    </form>

    <!-- 🔐 OTP Modal -->
    <div x-show="otpModal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
      <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-md relative" @click.outside="otpModal=false">
        <h2 class="text-xl font-bold text-green-700 mb-3 text-center">Verify Your Email</h2>
        <p class="text-gray-600 text-center mb-6">Enter the code sent to <span class="font-semibold text-green-700" x-text="form.email"></span></p>

        <input type="text" maxlength="6" x-model="otp" placeholder="Enter 6-digit OTP" class="block w-full text-center border border-gray-300 rounded-lg p-3 text-lg tracking-widest focus:ring-green-500 focus:border-green-500 shadow-sm">

        <div class="flex justify-between items-center mt-5">
          <button @click="verifyOtp" class="px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition">Verify</button>
          <button @click="resendOtp" x-bind:disabled="resendDisabled" class="text-green-600 hover:text-green-700 font-semibold disabled:opacity-50">
            <span x-show="resendDisabled">Resend (<span x-text="timer"></span>s)</span>
            <span x-show="!resendDisabled">Resend OTP</span>
          </button>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
function membershipForm() {
  return {
    loading: false,
    loadingText: "Submitting your details...",
    otpModal: false,
    otp: '',
    resendDisabled: true,
    timer: 30,
    countdown: null,
    form: { name:'', organization:'', email:'', phone:'', county:'', thematicgroup:'' },

    async submitForm() {
      this.loading = true;
      try {
        const response = await fetch("{{ route('membership.sendOtp') }}", {
          method: "POST",
          headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value },
          body: JSON.stringify(this.form)
        });

        const data = await response.json();
        this.loading = false;

        if (data.status === 'success') {
          this.otpModal = true;
          this.startTimer();
        } else {
          alert('Something went wrong. Try again.');
        }
      } catch (err) {
        this.loading = false;
        alert('Network error.');
      }
    },

    async verifyOtp() {
      this.loading = true;
      this.loadingText = "Verifying OTP...";
      try {
        const response = await fetch("{{ route('membership.verifyOtp') }}", {
          method: "POST",
          headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value },
          body: JSON.stringify({ otp: this.otp })
        });

        const data = await response.json();
        this.loading = false;

        if (data.status === 'verified') {
          window.location.href = data.redirect;
        } else {
          alert(data.message || "Invalid OTP.");
        }
      } catch {
        this.loading = false;
        alert('Error verifying OTP.');
      }
    },

    async resendOtp() {
      this.resendDisabled = true;
      this.timer = 30;
      this.startTimer();

      await fetch("{{ route('membership.resendOtp') }}", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value }
      });
    },

    startTimer() {
      clearInterval(this.countdown);
      this.countdown = setInterval(() => {
        this.timer--;
        if (this.timer <= 0) {
          clearInterval(this.countdown);
          this.resendDisabled = false;
        }
      }, 1000);
    },
  }
}
</script>
@endsection
