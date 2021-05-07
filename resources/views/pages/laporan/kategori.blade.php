<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kategori</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" defer>
</head>
<body>
    <center>
		<h2>Laporan Kategori</h2>
	</center>

    <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" style="border: 1px #000 solid;">
                    <thead>
                        <tr class="text-center align-items-center">
                            <th style="border: 1px #000 solid;">No</th>
                            <th style="border: 1px #000 solid;">Nama Kategori</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @php
                        $no = 0;
                        @endphp
                        @forelse ($items as $item)
                        @php
                        $no++;
                        @endphp
                        <tr class="align-items-center">
                            <th style="border: 1px #000 solid; text-align: center;">{{ $no }}</th>
                            <td style="border: 1px #000 solid; text-align: center;">{{ $item->name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                Data Kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous" defer></script>
</body>
</html>