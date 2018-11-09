@extends('layouts.app_layout')

@section('title','Home Page')

@section('content')

<style>
    table tr td{
        padding: 10px 10px 10px 0;
    }
    table tr td:nthchild(n-2){
        padding-left: 0;
    }
</style>

<div class="addstore-main-container">
    <div class="addstore-main-heading">Add Store</div>
    <hr>
    <div class="addstore-form-container">
        <table style="width: 100%;" cellspacing="30">
            <tr>
                <td>
                    Store Title
                    <input type="text" style="width: 100%;"/>
                </td>
                <td>
                    Store Logo
                    <input type="text" style="width: 100%;"/>
                </td>
            </tr>
            <tr>
                <td>
                    Store Title
                    <input type="text" style="width: 100%;"/>
                </td>
                <td>
                    Store Logo
                    <input type="text" style="width: 100%;"/>
                </td>
            </tr>
        </table>
    </div>
</div>

@endsection