
<!--begin: Datatable-->
<table class="datatable datatable-borderless">
    <thead>
    <tr>
        <th style="font-weight:bold">No</th>
        <th style="font-weight:bold">Imei</th>
        <th style="font-weight:bold">Customer Name</th>
        <th style="font-weight:bold">Email</th>
        <th style="font-weight:bold">Contact</th>
        <th style="font-weight:bold">Contact Alternatif</th>
        <th style="font-weight:bold">Identity</th>
        <th style="font-weight:bold">Birth Date</th>
        <th style="font-weight:bold">Gender</th>
        <th style="font-weight:bold">Address</th>
        <th style="font-weight:bold">Voucher Type</th>
        <th style="font-weight:bold">Lokasi Beli Membership</th>
        <th style="font-weight:bold">Device Type</th>
        <th style="font-weight:bold">Device Manufacturer</th>
        <th style="font-weight:bold">Device Model</th>
        <th style="font-weight:bold">Device Ram</th>
        <th style="font-weight:bold">Device Storage</th>
        <th style="font-weight:bold">Screen Has Problem?</th>
        <th style="font-weight:bold">Tanggal Kerusakan</th>
        <th style="font-weight:bold">Waktu Kerusakan</th>
        <th style="font-weight:bold">Provinsi</th>
        <th style="font-weight:bold">Kota</th>
        <th style="font-weight:bold">Alamat Penjemputan/Antar</th>
        <th style="font-weight:bold">Kode pos</th>
        <th style="font-weight:bold">Layanan Perbaikan</th>
        <th style="font-weight:bold">Kronologis</th>
        <th style="font-weight:bold">Activation Date</th>
        <th style="font-weight:bold">Expiration Date</th>
        <th style="font-weight:bold">Rejected Claim Date</th>

       
    
    </tr>
    </thead>
    <tbody>
    @php
        $num = 0
    @endphp
    @foreach ($rejected_claim_data as $rejected_claim)
    <tr> 
        @if ($rejected_claim->status == -3) 
        <td>{{ $num+=1 }}</td>
        <td>{{ $rejected_claim->imei }}</td>
        <td>{{ $rejected_claim->customers->users->name }}</td>
        <td>{{ $rejected_claim->customers->users->email }}</td>
        <td>{{ $rejected_claim->customers->contact }}</td>
        <td>{{ $rejected_claim->contact_alternatif }}</td>
        <td>{{ $rejected_claim->customers->identity }}</td>
        <td>{{ $rejected_claim->customers->birth_date }}</td>
        <td>{{ $rejected_claim->customers->gender }}</td>
        <td>{{ $rejected_claim->customers->address }}</td>
        <td>{{ $rejected_claim->vouchers->type }}</td>
        <td>{{ $rejected_claim->lokasi_beli_voucher }}</td>
        <td>{{ $rejected_claim->device_type }}</td>
        <td>{{ $rejected_claim->device_manufacturer }}</td>
        <td>{{ $rejected_claim->device_model }}</td>
        <td>{{ $rejected_claim->device_ram }}</td>
        <td>{{ $rejected_claim->device_storage }}</td>
        @if ($rejected_claim->screen_has_problem == 0)
        <td>No</td> 
        @endif
        @if ($rejected_claim->screen_has_problem == 1)
        <td>Yes</td>
        @endif
        <td>{{ $rejected_claim->tanggal_kerusakan }}</td>
        <td>{{ $rejected_claim->waktu_kerusakan }}</td>
        <td>{{ $rejected_claim->provinsi }}</td>
        <td>{{ $rejected_claim->kota }}</td>
        <td>{{ $rejected_claim->alamat_penjemputan }}</td>
        <td>{{ $rejected_claim->kode_pos }}</td>
        <td>{{ $rejected_claim->layanan_perbaikan }}</td>
        <td>{{ $rejected_claim->kronologis }}</td>
        <td>{{ $rejected_claim->actived_at }}</td>
        <td>{{ $rejected_claim->expired_at }}</td>
        <td>{{ $rejected_claim->updated_at }}</td>
        @endif
    </tr>
    @endforeach
    </tbody>
    </table>
    <!--end: Datatable-->
                                                    