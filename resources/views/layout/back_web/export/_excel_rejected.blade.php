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
        <th style="font-weight:bold">Reason For Rejected</th>
        <th style="font-weight:bold">Assign By</th>
        <th style="font-weight:bold">Rejected Date</th>

       
    
    </tr>
    </thead>
    <tbody>
    @php
        $num = 0
    @endphp
    @foreach ($rejected_data as $rejected)
    <tr> 
        @if ($rejected->status == -1) 
        <td>{{ $num+=1 }}</td>
        <td>{{ $rejected->imei }}</td>
        <td>{{ $rejected->vouchers->partners->users->name }}</td>
        <td>{{ $rejected->customers->users->name }}</td>
        <td>{{ $rejected->customers->users->email }}</td>
        <td>{{ $rejected->customers->identity }}</td>
        <td>{{ $rejected->customers->birth_date }}</td>
        <td>{{ $rejected->customers->gender }}</td>
        <td>{{ $rejected->customers->address }}</td>
        <td>{{ $rejected->customers->contact }}</td>
        <td>{{ $rejected->vouchers->type }}</td>
        <td>{{ $rejected->lokasi_beli_voucher }}</td>
        <td>{{ $rejected->device_type }}</td>
        <td>{{ $rejected->device_manufacturer }}</td>
        <td>{{ $rejected->device_model }}</td>
        <td>{{ $rejected->device_ram }}</td>
        <td>{{ $rejected->device_storage }}</td>
        @if ($rejected->screen_has_problem == 0)
        <td>No</td>
        @endif
        @if ($rejected->screen_has_problem == 1)
        <td>Yes</td>
        @endif
        <td>{{ $rejected->reason_for_rejected }}</td>
        <td>{{ $rejected->assign_by }}</td>
        <td>{{ $rejected->updated_at }}</td>
        @endif
    </tr>
    @endforeach
    </tbody>
    </table>
    <!--end: Datatable-->
                                                    