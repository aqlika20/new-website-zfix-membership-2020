
<!--begin: Datatable-->
<table class="datatable datatable-borderless">
    <thead>
    <tr>
        <th style="font-weight:bold">No</th>
        <th style="font-weight:bold">Imei</th>
        <th style="font-weight:bold">Customer Type</th>
        <th style="font-weight:bold">Customer Name</th>
        <th style="font-weight:bold">Email</th>
        <th style="font-weight:bold">No. KTP</th>
        <th style="font-weight:bold">Birth Date</th>
        <th style="font-weight:bold">Gender</th>
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
        <th style="font-weight:bold">Assign By</th>      
        <th style="font-weight:bold">Approved Date</th>      

       
    
    </tr>
    </thead>
    <tbody>
    @php
        $num = 0
    @endphp
    @foreach ($approved_data as $approved)
    <tr>
        @if ($approved->status == 1) 
        <td>{{ $num+=1 }}</td>
        <td>{{ $approved->imei }}</td>
        <td>{{ $approved->vouchers->partners->users->name }}</td>
        <td>{{ $approved->customers->users->name }}</td>
        <td>{{ $approved->customers->users->email }}</td>
        <td>{{ $approved->customers->identity }}</td>
        <td>{{ $approved->customers->birth_date }}</td>
        <td>{{ $approved->customers->gender }}</td>
        <td>{{ $approved->customers->address }}</td>
        <td>{{ $approved->customers->contact }}</td>
        <td>{{ $approved->vouchers->type }}</td>
        <td>{{ $approved->lokasi_beli_voucher }}</td>
        <td>{{ $approved->device_type }}</td>
        <td>{{ $approved->device_manufacturer }}</td>
        <td>{{ $approved->device_model }}</td>
        <td>{{ $approved->device_ram }}</td>
        <td>{{ $approved->device_storage }}</td>
        @if ($approved->screen_has_problem == 0)
        <td>No</td>
        @endif
        @if ($approved->screen_has_problem == 1)
        <td>Yes</td>
        @endif
        <td>{{ $approved->assign_by }}</td>
        <td>{{ $approved->updated_at }}</td>
        @endif
    </tr>
    @endforeach
    </tbody>
    </table>
    <!--end: Datatable-->
                                                    