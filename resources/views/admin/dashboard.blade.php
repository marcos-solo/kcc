@extends('layouts.admin') <!-- Assuming your admin layout is saved as layouts/admin.blade.php -->

@section('title', 'Admin Dashboard')

@section('content')
<h2 class="text-2xl font-bold text-green-700 mb-6">Members List</h2>

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
        <thead class="bg-green-100">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Phone</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Organization</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">County</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Thematic Group</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($members as $index => $member)
            <tr class="hover:bg-green-50 transition">
                <td class="px-4 py-2 text-sm text-gray-600">{{ $index + 1 }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->name }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->email }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->phone }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->organization }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->county }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->thematicgroup }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                    No members found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination (if using Laravel pagination) -->
<div class="mt-6">
    {{ $members->links() }}
</div>

@endsection
