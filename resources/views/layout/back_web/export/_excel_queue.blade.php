
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
        <th style="font-weight:bold">Request Activation Date</th>       
    
    </tr>
    </thead>
    <tbody>
    @php
        $num = 0
    @endphp
    @foreach ($queue_data as $queue)
    <tr>
        @if ($queue->status == 0) 
        <td>{{ $num+=1 }}</td>
        <td>{{ $queue->imei }}</td>
        <td>{{ $queue->vouchers->partners->users->name }}</td>
        <td>{{ $queue->customers->users->name }}</td>
        <td>{{ $queue->customers->users->email }}</td>
        <td>{{ $queue->customers->identity }}</td>
        <td>{{ $queue->customers->birth_date }}</td>
        <td>{{ $queue->customers->gender }}</td>
        <td>{{ $queue->customers->address }}</td>
        <td>{{ $queue->customers->contact }}</td>
        <td>{{ $queue->vouchers->type }}</td>
        <td>{{ $queue->lokasi_beli_voucher }}</td>
        <td>{{ $queue->device_type }}</td>
        <td>{{ $queue->device_manufacturer }}</td>
        <td>{{ $queue->device_model }}</td>
        <td>{{ $queue->device_ram }}</td>
        <td>{{ $queue->device_storage }}</td>
        @if ($queue->screen_has_problem == 0)
        <td>No</td>
        @endif
        @if ($queue->screen_has_problem == 1)
        <td>Yes</td>
        @endif
        <td>{{ $queue->updated_at }}</td>
        @endif
    </tr>
    @endforeach
    </tbody>
    </table>
    <!--end: Datatable-->
                                                    