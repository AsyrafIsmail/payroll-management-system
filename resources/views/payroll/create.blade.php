<form method="POST" action="{{ route('payroll.store') }}">
    @csrf

    <label>Month</label>
    <select name="month" required>
        @foreach(range(1, 12) as $month)
            <option value="{{ $month }}">
                {{ DateTime::createFromFormat('!m', $month)->format('F') }}
            </option>
        @endforeach
    </select>

    <label>Year</label>
    <input type="number" name="year" value="{{ now()->year }}" required>

    <button type="submit">
        Run Payroll
    </button>
</form>
