@extends('layouts.app')

@section('title', 'Resources & Equipment')

@section('content')
<style>
    .re-page {
        color: #172b4d;
        font-family: inherit;
        padding-bottom: 35px;
    }

    .re-page * {
        box-sizing: border-box;
    }

    .re-hero {
        background: linear-gradient(120deg, #061d40, #123d70);
        color: white;
        border-radius: 18px;
        padding: 30px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .re-hero h1 {
        color: white;
        font-size: 30px;
        font-weight: 800;
        margin: 0 0 10px;
    }

    .re-hero p {
        color: #dbeafe;
        font-size: 16px;
        line-height: 1.7;
        margin: 0;
    }

    .re-hero-icon {
        font-size: 55px;
        background: rgba(255,255,255,.12);
        border-radius: 18px;
        width: 90px;
        height: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .re-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 25px;
    }

    .re-stat {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 22px;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .04);
    }

    .re-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 17px;
    }

    .re-stat-label {
        font-size: 14px;
        color: #64748b;
        font-weight: 700;
    }

    .re-stat-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eff6ff;
        font-size: 22px;
    }

    .re-stat-number {
        font-size: 30px;
        font-weight: 800;
        color: #102c50;
        line-height: 1.2;
    }

    .re-stat-note {
        font-size: 12px;
        color: #64748b;
        margin-top: 8px;
    }

    .re-panel {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 24px;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .04);
    }

    .re-panel-heading {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 22px;
    }

    .re-panel-heading h2 {
        margin: 0 0 7px;
        font-size: 22px;
        font-weight: 800;
        color: #102c50;
    }

    .re-panel-heading p {
        margin: 0;
        font-size: 14px;
        color: #64748b;
        line-height: 1.6;
    }

    .re-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        border: none;
        border-radius: 9px;
        padding: 12px 18px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .re-btn-primary {
        background: #123d70;
        color: white;
    }

    .re-btn-primary:hover {
        background: #061d40;
        color: white;
    }

    .re-btn-light {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
    }

    .re-form-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }

    .re-field {
        min-width: 0;
    }

    .re-field.full {
        grid-column: 1 / -1;
    }

    .re-field label {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 9px;
    }

    .re-field input,
    .re-field select,
    .re-field textarea {
        display: block;
        width: 100%;
        min-height: 46px;
        padding: 11px 13px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        background: #fff;
        color: #172b4d;
        font-size: 14px;
        outline: none;
    }

    .re-field textarea {
        min-height: 100px;
        resize: vertical;
    }

    .re-field input:focus,
    .re-field select:focus,
    .re-field textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,.10);
    }

    .re-form-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-top: 22px;
        flex-wrap: wrap;
    }

    .re-filters {
        display: grid;
        grid-template-columns: minmax(220px, 1fr) minmax(180px, 240px);
        gap: 14px;
        margin-bottom: 22px;
    }

    .re-search {
        position: relative;
    }

    .re-search span {
        position: absolute;
        left: 14px;
        top: 12px;
        font-size: 17px;
    }

    .re-search input,
    .re-filters select {
        width: 100%;
        height: 46px;
        padding: 10px 13px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        background: white;
        color: #334155;
        font-size: 14px;
    }

    .re-search input {
        padding-left: 42px;
    }

    .re-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }

    .re-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
        text-align: left;
    }

    .re-table thead {
        background: #f1f5f9;
    }

    .re-table th {
        padding: 16px 18px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .45px;
        color: #475569;
        white-space: nowrap;
    }

    .re-table td {
        padding: 17px 18px;
        border-top: 1px solid #e2e8f0;
        color: #334155;
        font-size: 14px;
        vertical-align: middle;
    }

    .re-table tbody tr:hover {
        background: #f8fafc;
    }

    .re-item {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 180px;
    }

    .re-item-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 43px;
        height: 43px;
        flex-shrink: 0;
        border-radius: 11px;
        background: #eff6ff;
        font-size: 22px;
    }

    .re-item-name {
        font-weight: 800;
        color: #102c50;
        margin-bottom: 5px;
    }

    .re-item-sub {
        font-size: 12px;
        color: #64748b;
    }

    .re-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .re-green {
        background: #dcfce7;
        color: #166534;
    }

    .re-yellow {
        background: #fef3c7;
        color: #92400e;
    }

    .re-red {
        background: #fee2e2;
        color: #991b1b;
    }

    .re-blue {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .re-empty {
        text-align: center;
        padding: 45px 20px;
    }

    .re-empty-icon {
        font-size: 42px;
        margin-bottom: 12px;
    }

    .re-empty h3 {
        color: #102c50;
        font-size: 19px;
        margin: 0 0 8px;
    }

    .re-empty p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .re-alert {
        padding: 14px 16px;
        border-radius: 9px;
        margin-bottom: 18px;
        font-size: 14px;
    }

    .re-alert-success {
        background: #dcfce7;
        color: #166534;
    }

    .re-alert-error {
        background: #fee2e2;
        color: #991b1b;
    }

    .re-hidden {
        display: none;
    }

    @media (max-width: 1100px) {
        .re-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .re-form-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .re-hero {
            padding: 22px;
        }

        .re-hero h1 {
            font-size: 24px;
        }

        .re-hero-icon {
            display: none;
        }

        .re-stats {
            grid-template-columns: 1fr;
        }

        .re-form-grid,
        .re-filters {
            grid-template-columns: 1fr;
        }

        .re-panel {
            padding: 18px;
        }

        .re-panel-heading h2 {
            font-size: 20px;
        }

        .re-form-actions .re-btn,
        .re-panel-heading .re-btn {
            width: 100%;
        }
    }
</style>

<div class="re-page">

    <div class="re-hero">
        <div>
            <h1>Resources &amp; Equipment</h1>
            <p>
                Campus emergency inventory, safety supplies and response equipment
                management in one place.
            </p>
        </div>
        <div class="re-hero-icon">🧯</div>
    </div>

    @if(session('success'))
        <div class="re-alert re-alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="re-alert re-alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="re-alert re-alert-error">
            <strong>Please correct the following errors:</strong>
            <ul style="margin:8px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="re-stats">
        <div class="re-stat">
            <div class="re-stat-top">
                <span class="re-stat-label">Total Equipment</span>
                <span class="re-stat-icon">📦</span>
            </div>
            <div class="re-stat-number" id="reTotal">0</div>
            <div class="re-stat-note">Inventory records displayed</div>
        </div>

        <div class="re-stat">
            <div class="re-stat-top">
                <span class="re-stat-label">Available Items</span>
                <span class="re-stat-icon">✅</span>
            </div>
            <div class="re-stat-number" id="reAvailable">0</div>
            <div class="re-stat-note">Marked available in inventory</div>
        </div>

        <div class="re-stat">
            <div class="re-stat-top">
                <span class="re-stat-label">Low Stock</span>
                <span class="re-stat-icon">⚠️</span>
            </div>
            <div class="re-stat-number" id="reLowStock">0</div>
            <div class="re-stat-note">Items with quantity of 5 or less</div>
        </div>

        <div class="re-stat">
            <div class="re-stat-top">
                <span class="re-stat-label">Categories</span>
                <span class="re-stat-icon">🗂️</span>
            </div>
            <div class="re-stat-number" id="reCategories">0</div>
            <div class="re-stat-note">Different equipment categories</div>
        </div>
    </div>

    <div class="re-panel" id="reAddForm">
        <div class="re-panel-heading">
            <div>
                <h2>➕ Add New Equipment</h2>
                <p>Enter equipment details to register an inventory item.</p>
            </div>
        </div>

        <form id="reEquipmentForm" method="POST" action="{{ url('/resources-equipment') }}">
            @csrf

            <div class="re-form-grid">
                <div class="re-field">
                    <label for="reName">Equipment Name *</label>
                    <input
                        type="text"
                        id="reName"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="e.g. First Aid Kit"
                        required
                    >
                </div>

                <div class="re-field">
                    <label for="reCategory">Category *</label>
                    <select id="reCategory" name="category" required>
                        <option value="">Select category</option>
                        @foreach([
                            'Medical Supplies',
                            'Fire Safety',
                            'Rescue Equipment',
                            'Communication',
                            'Emergency Vehicles',
                            'Protective Equipment',
                            'Other'
                        ] as $category)
                            <option value="{{ $category }}" @selected(old('category') === $category)>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="re-field">
                    <label for="reQuantity">Quantity *</label>
                    <input
                        type="number"
                        id="reQuantity"
                        name="quantity"
                        value="{{ old('quantity', 1) }}"
                        min="0"
                        placeholder="Enter quantity"
                        required
                    >
                </div>

                <div class="re-field">
                    <label for="reLocation">Storage Location *</label>
                    <input
                        type="text"
                        id="reLocation"
                        name="location"
                        value="{{ old('location') }}"
                        placeholder="e.g. Main Building, Room 101"
                        required
                    >
                </div>

                <div class="re-field">
                    <label for="reCondition">Equipment Condition *</label>
                    <select id="reCondition" name="condition" required>
                        <option value="">Select condition</option>
                        <option value="Good" @selected(old('condition') === 'Good')>Good</option>
                        <option value="Needs Repair" @selected(old('condition') === 'Needs Repair')>Needs Repair</option>
                        <option value="Damaged" @selected(old('condition') === 'Damaged')>Damaged</option>
                    </select>
                </div>

                <div class="re-field">
                    <label for="reStatus">Availability Status *</label>
                    <select id="reStatus" name="status" required>
                        <option value="Available" @selected(old('status', 'Available') === 'Available')>Available</option>
                        <option value="In Use" @selected(old('status') === 'In Use')>In Use</option>
                        <option value="Maintenance" @selected(old('status') === 'Maintenance')>Maintenance</option>
                    </select>
                </div>

                <div class="re-field full">
                    <label for="reDescription">Description / Notes</label>
                    <textarea
                        id="reDescription"
                        name="description"
                        placeholder="Add item details, expiry information or maintenance notes..."
                    >{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="re-form-actions">
                <button type="reset" class="re-btn re-btn-light">Clear Form</button>
                <button type="submit" class="re-btn re-btn-primary">Save Equipment</button>
            </div>
        </form>

        <div class="re-alert re-alert-error" style="margin:20px 0 0;">
            <strong>Important:</strong> The form layout is ready, but saving requires
            a matching database table and POST route/controller. Do not submit it
            until that backend is connected.
        </div>
    </div>

    <div class="re-panel">
        <div class="re-panel-heading">
            <div>
                <h2>Equipment Inventory</h2>
                <p>Search and filter the inventory shown in this page.</p>
            </div>
            <button type="button" class="re-btn re-btn-primary"
                    onclick="document.getElementById('reAddForm').scrollIntoView({behavior:'smooth'}); document.getElementById('reName').focus();">
                + Add Equipment
            </button>
        </div>

        <div class="re-filters">
            <div class="re-search">
                <span>🔎</span>
                <input type="search" id="reSearch" placeholder="Search equipment, category or location...">
            </div>

            <select id="reFilterCategory">
                <option value="">All Categories</option>
                <option>Medical Supplies</option>
                <option>Fire Safety</option>
                <option>Rescue Equipment</option>
                <option>Communication</option>
                <option>Emergency Vehicles</option>
                <option>Protective Equipment</option>
                <option>Other</option>
            </select>
        </div>

        <div class="re-table-wrap">
            <table class="re-table" id="reInventoryTable">
                <thead>
                    <tr>
                        <th>Equipment</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Location</th>
                        <th>Condition</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="reInventoryBody">
                    <tr id="reEmptyRow">
                        <td colspan="6">
                            <div class="re-empty">
                                <div class="re-empty-icon">📋</div>
                                <h3>No Equipment Records Yet</h3>
                                <p>Equipment records will appear here after the database is connected.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p id="reNoResults" class="re-hidden"
           style="text-align:center;padding:24px;color:#64748b;">
            No matching equipment found. Try a different search.
        </p>
    </div>

</div>

<script>
(function () {
    const search = document.getElementById('reSearch');
    const category = document.getElementById('reFilterCategory');
    const body = document.getElementById('reInventoryBody');

    function filterInventory() {
        const query = search.value.toLowerCase().trim();
        const selectedCategory = category.value.toLowerCase();
        const rows = body.querySelectorAll('tr[data-equipment-row]');
        let visible = 0;
        let available = 0;
        let lowStock = 0;
        const categories = new Set();

        rows.forEach(function (row) {
            const text = row.innerText.toLowerCase();
            const rowCategory = (row.dataset.category || '').toLowerCase();
            const qty = parseInt(row.dataset.quantity || '0', 10);
            const status = (row.dataset.status || '').toLowerCase();

            const matchesSearch = !query || text.includes(query);
            const matchesCategory = !selectedCategory || rowCategory === selectedCategory;
            const show = matchesSearch && matchesCategory;

            row.style.display = show ? '' : 'none';

            if (show) {
                visible++;
                categories.add(rowCategory);
                if (status === 'available') available++;
                if (qty <= 5) lowStock++;
            }
        });

        document.getElementById('reTotal').textContent = visible;
        document.getElementById('reAvailable').textContent = available;
        document.getElementById('reLowStock').textContent = lowStock;
        document.getElementById('reCategories').textContent = categories.size;

        document.getElementById('reNoResults').classList.toggle(
            're-hidden',
            visible > 0 || rows.length === 0
        );

        const emptyRow = document.getElementById('reEmptyRow');
        if (emptyRow) {
            emptyRow.style.display = rows.length === 0 ? '' : 'none';
        }
    }

    search.addEventListener('input', filterInventory);
    category.addEventListener('change', filterInventory);
    filterInventory();
})();
</script>
@endsection