@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
  <h1 class="text-2xl font-bold text-green-800 mb-6">Add New Team Member</h1>

  <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
    @csrf

    <div class="mb-4">
      <label class="block font-semibold text-gray-700">Name</label>
      <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name') }}" required>
    </div>

    <div class="mb-4">
      <label class="block font-semibold text-gray-700">Role</label>
      <input type="text" name="role" class="w-full border rounded p-2" value="{{ old('role') }}" required>
    </div>

    <div class="mb-4">
      <label class="block font-semibold text-gray-700">Bio</label>
      <textarea name="bio" rows="4" class="w-full border rounded p-2">{{ old('bio') }}</textarea>
    </div>

    <div class="mb-4">
      <label class="block font-semibold text-gray-700">Profile Image</label>
      <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
    </div>

    <div class="mb-6">
      <label class="inline-flex items-center">
        <input type="checkbox" name="active" value="1" checked class="text-green-600 rounded">
        <span class="ml-2 text-gray-700">Active Member</span>
      </label>
    </div>

    <div class="flex justify-end gap-3">
      <a href="{{ route('admin.team.index') }}" class="bg-gray-200 px-4 py-2 rounded">Cancel</a>
      <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">Save</button>
    </div>
  </form>
</div>
@endsection
