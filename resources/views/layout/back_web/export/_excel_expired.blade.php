
<!--begin: Datatable-->
<table class="datatable datatable-borderless">
    <thead>
    <tr>
        <th style="font-weight:bold">No</th>
        <th style="font-weight:bold">Imei</th>
        <th style="font-weight:bold">Customer Name</th>
        <th style="font-weight:bold">Email</th>
        <th style="font-weight:bold">Address</th>
        <th style="font-weight:bold">Contact</th>
        <th style="font-weight:bold">Voucher Type</th>
        <th style="font-weight:bold">Lokasi Beli Membership</th>
        <th style="font-weight:bold">Device Type</th>
        <th style="font-weight:bold">Device Manufacturer</th>
        <th style="font-weight:bold">Device Model</th>
        <th style="font-weight:bold">Device Ram</th>
        <th style="font-weight:bold">Device Storage</th>
        <th style="font-weight:bold">Screen Has Problem?</th>
        <th style="font-weight:bold">Activation Date</th>
        <th style="font-weight:bold">Expiration Date</th>
       
    
    </tr>
    </thead>
    <tbody>
    @php
        $num = 0
    @endphp
    @foreach ($expired_data as $expired)
    <tr>
        <td>{{ $num+=1 }}</td>
        <td>{{ $expired->imei }}</td>
        <td>{{ $expired->customers->users->name }}</td>
        <td>{{ $expired->customers->users->email }}</td>
        <td>{{ $expired->customers->address }}</td>
        <td>{{ $expired->customers->contact }}</td>
        <td>{{ $expired->vouchers->type }}</td>
        <td>{{ $expired->lokasi_beli_voucher }}</td>
        <td>{{ $expired->device_type }}</td>
        <td>{{ $expired->device_manufacturer }}</td>
        <td>{{ $expired->device_model }}</td>
        <td>{{ $expired->device_ram }}</td>
        <td>{{ $expired->device_storage }}</td>
        @if ($expired->screen_has_problem == 0)
        <td>No</td> 
        @endif
        @if ($expired->screen_has_problem == 1)
        <td>Yes</td>
        @endif
        <td>{{ $expired->actived_at }}</td>
        <td>{{ $expired->expired_at }}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
    <!--end: Datatable-->
                                                    