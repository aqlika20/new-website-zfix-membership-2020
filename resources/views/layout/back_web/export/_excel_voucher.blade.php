
<!--begin: Datatable-->
<table class="datatable datatable-borderless">
<thead>
<tr>
    <th style="font-weight:bold">#</th>
    <th style="font-weight:bold">Name</th>
    @if ($currentUser->roles_id != 4) 
    <th style="font-weight:bold">Voucher Key</th>
    @endif
    <th style="font-weight:bold">Serial Number</th>
    <th style="font-weight:bold">Type</th>
    @if ($status == 0) 
    <th style="font-weight:bold">Created Date</th>
    @endif
    @if ($status == 1) 
    <th style="font-weight:bold">Sold Date</th>
    @endif
    @if ($status == 2) 
    <th style="font-weight:bold">Actived Date</th>
    @endif

</tr>
</thead>
<tbody>
@php
    $num = 0
@endphp
@foreach ($vouchers_data as $voucher)
<tr>
    <td>{{ $num+=1 }}</td>
    <td>{{ $voucher->partners->users->name }}</td>
    @if ($currentUser->roles_id != 4) 
    <td>{{ $voucher->voucher_key }}</td>
    @endif
    <td>{{ $voucher->serial_number }}</td>
    <td>{{ $voucher->type }}</td>
    <td>{{ $voucher->updated_at }}</td>
</tr>
@endforeach
</tbody>
</table>
<!--end: Datatable-->
                                                 