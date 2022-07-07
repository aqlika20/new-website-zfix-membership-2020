
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
        <th style="font-weight:bold">Claimed Date</th>

       
    
    </tr>
    </thead>
    <tbody>
    @php
        $num = 0
    @endphp
    @foreach ($claimed_data as $claimed)
    <tr>
        @if ($claimed->status == 3) 
        <td>{{ $num+=1 }}</td>
        <td>{{ $claimed->imei }}</td>
        <td>{{ $claimed->customers->users->name }}</td>
        <td>{{ $claimed->customers->users->email }}</td>
        <td>{{ $claimed->customers->contact }}</td>
        <td>{{ $claimed->contact_alternatif }}</td>
        <td>{{ $claimed->customers->identity }}</td>
        <td>{{ $claimed->customers->birth_date }}</td>
        <td>{{ $claimed->customers->gender }}</td>
        <td>{{ $claimed->customers->address }}</td>
        <td>{{ $claimed->vouchers->type }}</td>
        <td>{{ $claimed->lokasi_beli_voucher }}</td>
        <td>{{ $claimed->device_type }}</td>
        <td>{{ $claimed->device_manufacturer }}</td>
        <td>{{ $claimed->device_model }}</td>
        <td>{{ $claimed->device_ram }}</td>
        <td>{{ $claimed->device_storage }}</td>
        @if ($claimed->screen_has_problem == 0)
        <td>No</td> 
        @endif
        @if ($claimed->screen_has_problem == 1)
        <td>Yes</td>
        @endif
        <td>{{ $claimed->tanggal_kerusakan }}</td>
        <td>{{ $claimed->waktu_kerusakan }}</td>
        <td>{{ $claimed->provinsi }}</td>
        <td>{{ $claimed->kota }}</td>
        <td>{{ $claimed->alamat_penjemputan }}</td>
        <td>{{ $claimed->kode_pos }}</td>
        <td>{{ $claimed->layanan_perbaikan }}</td>
        <td>{{ $claimed->kronologis }}</td>
        <td>{{ $claimed->actived_at }}</td>
        <td>{{ $claimed->expired_at }}</td>
        <td>{{ $claimed->updated_at }}</td>
        @endif
    </tr>
    @endforeach
    </tbody>
    </table>
    <!--end: Datatable-->
                                                    