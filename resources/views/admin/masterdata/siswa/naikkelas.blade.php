@extends('layout.main')
@section('content')
@php
    echo ("dydyyd");
@endphp
{{-- <span class="bg-warning p-3 w-100 d-flex justify-content-center my-4">Harap edit data dari kelas tertinggi
    (kelas6)</span>
<div class="accordion" id="accordionExample"> --}}
    <?php for ($i = 6; $i >= 1; $i--): ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse<?= $i ?>" aria-expanded="false" aria-controls="collapse<?= $i ?>">
                    Kelas <?= $i ?>
                </button>
            </h2>
            <div id="collapse<?= $i ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="<?= BASEURL; ?>masterdata/naikSemua" method="post">
                        <input type="hidden" value="<?= $i; ?>" name="kelas">
                        <button type="submit" class="btn btn-success"><?= $i == 6 ? 'Lulus ' : 'Naik ' ?>Semua</button>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NIS</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data[$i] as $siswa): ?>
                                <tr>
                                    <td><?= $siswa['nis'] ?></td>
                                    <td><?= $siswa['nama'] ?></td>
                                    <td><?= $siswa['kelas'] ?></td>
                                    <td>
                                        <form method="POST" action="<?= BASEURL; ?>masterdata/naikSingel">
                                            <input type="hidden" name="nis" value="<?= $siswa['nis']; ?>">
                                            <input type="hidden" name="kelas" value="<?= $siswa['kelas']; ?>">
                                            <button type="submit"
                                                class="btn btn-success"><?= $i == 6 ? 'Lulus ' : 'Naik Kelas' ?></button>
                                        </form>

                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endfor; ?>

@endsection
