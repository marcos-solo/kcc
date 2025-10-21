@extends('layouts.admin')

@section('title', 'Analytics')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-green-700">Analytics Dashboard</h1>

@php
use App\Models\Member;

$totalMembers = Member::count();
$totalOrganizations = Member::distinct('organization')->count('organization');

$membersByCounty = Member::select('county', \DB::raw('count(*) as total'))
    ->groupBy('county')
    ->orderBy('total', 'desc')
    ->get();

$membersByGroup = Member::select('thematicgroup', \DB::raw('count(*) as total'))
    ->groupBy('thematicgroup')
    ->orderBy('total', 'desc')
    ->get();

$membersByOrganization = Member::select('organization', \DB::raw('count(*) as total'))
    ->groupBy('organization')
    ->orderBy('total', 'desc')
    ->get();

$highestCounty = $membersByCounty->first()?->county ?? 'N/A';
$highestCountyCount = $membersByCounty->first()?->total ?? 0;

$lowestCounty = $membersByCounty->last()?->county ?? 'N/A';
$lowestCountyCount = $membersByCounty->last()?->total ?? 0;

$highestOrg = $membersByOrganization->first()?->organization ?? 'N/A';
$highestOrgCount = $membersByOrganization->first()?->total ?? 0;

$lowestOrg = $membersByOrganization->last()?->organization ?? 'N/A';
$lowestOrgCount = $membersByOrganization->last()?->total ?? 0;

$counties = $membersByCounty->pluck('county')->map(fn($c) => $c ?? 'N/A')->toArray();
$countyCounts = $membersByCounty->pluck('total')->toArray();

$groups = $membersByGroup->pluck('thematicgroup')->map(fn($g) => $g ?? 'N/A')->toArray();
$groupCounts = $membersByGroup->pluck('total')->toArray();

$organizations = $membersByOrganization->pluck('organization')->map(fn($o) => $o ?? 'N/A')->toArray();
$orgCounts = $membersByOrganization->pluck('total')->toArray();
@endphp

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="font-semibold text-lg text-green-700 mb-3">Total Members</h2>
        <p class="text-2xl font-bold">{{ $totalMembers }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="font-semibold text-lg text-green-700 mb-3">Total Organizations</h2>
        <p class="text-2xl font-bold">{{ $totalOrganizations }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="font-semibold text-lg text-green-700 mb-3">Highest County</h2>
        <p class="text-xl font-bold">{{ $highestCounty }} ({{ $highestCountyCount }})</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="font-semibold text-lg text-green-700 mb-3">Lowest County</h2>
        <p class="text-xl font-bold">{{ $lowestCounty }} ({{ $lowestCountyCount }})</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Members per County -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="font-semibold text-lg text-green-700 mb-3">Members by County</h2>
        <canvas id="countyChart" class="mb-4"></canvas>
        <table class="w-full text-left border border-gray-200">
            <thead>
                <tr class="bg-green-100">
                    <th class="px-4 py-2 border">County</th>
                    <th class="px-4 py-2 border">Members</th>
                </tr>
            </thead>
            <tbody>
                @foreach($membersByCounty as $c)
                <tr class="hover:bg-green-50">
                    <td class="px-4 py-2 border">{{ $c->county ?? 'N/A' }}</td>
                    <td class="px-4 py-2 border">{{ $c->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Members per Thematic Group -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="font-semibold text-lg text-green-700 mb-3">Members by Thematic Group</h2>
        <canvas id="groupChart" class="mb-4"></canvas>
        <table class="w-full text-left border border-gray-200">
            <thead>
                <tr class="bg-green-100">
                    <th class="px-4 py-2 border">Thematic Group</th>
                    <th class="px-4 py-2 border">Members</th>
                </tr>
            </thead>
            <tbody>
                @foreach($membersByGroup as $g)
                <tr class="hover:bg-green-50">
                    <td class="px-4 py-2 border">{{ $g->thematicgroup ?? 'N/A' }}</td>
                    <td class="px-4 py-2 border">{{ $g->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Members per Organization -->
<div class="bg-white p-6 rounded-lg shadow mt-6">
    <h2 class="font-semibold text-lg text-green-700 mb-3">Members by Organization</h2>
    <canvas id="orgChart" class="mb-4"></canvas>
    <table class="w-full text-left border border-gray-200">
        <thead>
            <tr class="bg-green-100">
                <th class="px-4 py-2 border">Organization</th>
                <th class="px-4 py-2 border">Members</th>
            </tr>
        </thead>
        <tbody>
            @foreach($membersByOrganization as $o)
            <tr class="hover:bg-green-50">
                <td class="px-4 py-2 border">{{ $o->organization ?? 'N/A' }}</td>
                <td class="px-4 py-2 border">{{ $o->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const countyCtx = document.getElementById('countyChart').getContext('2d');
new Chart(countyCtx, {
    type: 'bar',
    data: {
        labels: @json($counties),
        datasets: [{
            label: 'Members',
            data: @json($countyCounts),
            backgroundColor: '#16a34a'
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false }, tooltip: { mode: 'index', intersect: false } },
        scales: { y: { beginAtZero: true } }
    }
});

const groupCtx = document.getElementById('groupChart').getContext('2d');
new Chart(groupCtx, {
    type: 'pie',
    data: {
        labels: @json($groups),
        datasets: [{
            data: @json($groupCounts),
            backgroundColor: ['#16a34a','#22c55e','#4ade80','#a7f3d0','#86efac','#bbf7d0','#bef264']
        }]
    },
    options: { responsive: true }
});

const orgColors = @json($orgCounts).map((val, i, arr) => {
    if (val === Math.max(...arr)) return '#15803d';
    if (val === Math.min(...arr)) return '#dc2626';
    return '#22c55e';
});

const orgCtx = document.getElementById('orgChart').getContext('2d');
new Chart(orgCtx, {
    type: 'bar',
    data: {
        labels: @json($organizations),
        datasets: [{
            label: 'Members',
            data: @json($orgCounts),
            backgroundColor: orgColors
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false }, tooltip: { mode: 'index', intersect: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endsection
