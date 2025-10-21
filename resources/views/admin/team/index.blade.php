@extends('layouts.admin')

@section('content')
<div class="p-6">
  <h1 class="text-2xl font-bold text-green-800 mb-6">Team Members</h1>

  @if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <div class="mb-4">
    <a href="{{ route('admin.team.create') }}" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
      ➕ Add New Member
    </a>
  </div>

  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full border border-gray-200">
      <thead class="bg-gray-100">
        <tr class="text-left text-gray-700">
          <th class="px-4 py-3 border-b">Image</th>
          <th class="px-4 py-3 border-b">Name</th>
          <th class="px-4 py-3 border-b">Role</th>
          <th class="px-4 py-3 border-b">Status</th>
          <th class="px-4 py-3 border-b text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($members as $member)
          <tr class="border-b hover:bg-gray-50">
            <td class="px-4 py-3">
              <img src="{{ $member->image ? asset('storage/'.$member->image) : 'https://via.placeholder.com/80' }}" 
                   class="w-14 h-14 rounded-full object-cover border">
            </td>
            <td class="px-4 py-3 font-semibold text-gray-800">{{ $member->name }}</td>
            <td class="px-4 py-3 text-gray-600">{{ $member->role }}</td>
            <td class="px-4 py-3">
              <span class="px-2 py-1 rounded text-sm {{ $member->active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $member->active ? 'Active' : 'Inactive' }}
              </span>
            </td>
            <td class="px-4 py-3 text-center">
              <a href="{{ route('admin.team.edit', $member->id) }}" class="text-blue-600 hover:underline">Edit</a>
              <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center text-gray-500 py-6">No team members found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
