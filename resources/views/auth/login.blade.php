@extends('adminlte::auth.login')

@section('adminlte_css_pre')
<style>
    .login-page {
        background: linear-gradient(135deg, #0d2818 0%, #1a4d3a 100%) !important;
    }
    .login-logo a {
        color: #d4af37 !important;
        font-weight: 900;
    }
    .card {
        border: 2px solid #d4af37;
    }
    .btn-primary {
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%) !important;
        border: none !important;
        color: #0d2818 !important;
        font-weight: 700;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
    }
</style>
@stop

