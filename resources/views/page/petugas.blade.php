@extends('layout.app')
@section('content')
    @include('component.searchbar')
    <div id="beranda" class="bg-lightgrey">
        <div class="flex items-center justify-center pt-4">
            <div class="flex sm:space-x-40 space-x-4">
                <button class="btn border-darkblue text-darkblue bg-white hover:border-darkblue hover:bg-white hover:text-darkblue">
                    Daftar Perusahaan:
                </button>
                <button class="btn border-darkblue text-darkblue bg-white hover:bg-darkblue hover:text-white">
                    Tambah Perusahaan
                    <img src="https://cdn1.iconfinder.com/data/icons/unicons-line-vol-5/24/plus-circle-64.png" 
                    alt=""
                    height="32"
                    width="32">
                </button>
            </div>
        </div>

        <div class="flex items-center justify-center py-8">
            <div class="overflow-x-auto">
                <table class="table table-zebra bg-white">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Job</th>
                        <th>Favorite Color</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row 1 -->
                    <tr>
                        <th>1</th>
                        <td>Cy Ganderton</td>
                        <td>Quality Control Specialist</td>
                        <td>Blue</td>
                        <td>
                            <button class="btn btn-ghost btn-xs">details</button>
                        </td>
                    </tr>
                    <!-- row 2 -->
                    <tr>
                        <th>2</th>
                        <td>Hart Hagerty</td>
                        <td>Desktop Support Technician</td>
                        <td>Purple</td>
                        <td>
                            <button class="btn btn-ghost btn-xs">details</button>
                        </td>
                    </tr>
                    <!-- row 3 -->
                    <tr>
                        <th>3</th>
                        <td>Brice Swyre</td>
                        <td>Tax Accountant</td>
                        <td>Red</td>
                        <td>
                            <button class="btn btn-ghost btn-xs">details</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection