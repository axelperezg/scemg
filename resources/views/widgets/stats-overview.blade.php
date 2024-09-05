<!-- resources/views/widgets/stats-overview.blade.php -->

<div class="stats-overview-widget">
    <div class="stat-card">
        <h3>Total Sectors</h3>
        <p>{{ $totalSectors }}</p>
    </div>
    <div class="stat-card">
        <h3>Total Institutions</h3>
        <p>{{ $totalInstitutions }}</p>
    </div>
</div>

<style>
    .stats-overview-widget {
        display: flex;
        gap: 20px;
    }
    .stat-card {
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        text-align: center;
    }
</style>