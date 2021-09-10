@extends('layouts.app')
@section('content')
<div class="statbox widget box box-shadow">
    <div class="widget-content widget-content-area">
        <table id="style-1" class="table style-1 dt-table-hover non-hover">
            <thead>
                <tr>
                    <th class="checkbox-column dt-no-sorting"> ID </th>
                    <th>Title</th>
                    <th>User</th>
                    <th>Division</th>
                    <th>Content</th>
                    <th class="">Status</th>
                    <th class="text-center dt-no-sorting">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="checkbox-column"> 1 </td>
                    <td class="user-name">Sean Freeman</td>
                    <td class="user-name">Sean Freeman</td>
                    <td>seanfreeman@admin.com</td>
                    <td>555-555-5555</td>
                    <td>
                        <div class="d-flex">
                            <div class=" align-self-center d-m-success  mr-1 data-marker"></div>
                            <span class="label label-success">Approved</span>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-more-horizontal">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <a class="dropdown-item" href="javascript:void(0);">View</a>
                                <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);">View
                                    Response</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
