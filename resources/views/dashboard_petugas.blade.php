<h2>Dashboard Petugas</h2>
<p>Selamat datang, {{ Auth::user()->name }} ({{ Auth::user()->role }})</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
