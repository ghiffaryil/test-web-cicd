<?php $this->extend('layout/SuperAdmin'); ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"> Data Seting web semua user</h4>
              <!-- Bootstrap Table with Header - Light -->
              <div class="card">
                <h5 class="card-header">Table Data seting</h5>
                <div class="table-responsive text-wrap">
                  <div class="card-body">
                    </div>
            <?php if($role['read_data'] == 'Y') {?>
                  <table class="table">
                    <thead class="table-light">
                      <tr>
                        <th>No</th>
                        <th>Owner</th>
                        <th>Organisasi</th>
                        <th>Organisasi Kode</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php 
                    $no = 1;
                    foreach($data as $d) { ?>
                           <tr>
                        <td><?= $no++?></td>
                        <td><?= $d['id_pengguna']['username']?></td>
                        <td><?= $d['organisasi_kode']['nama_organisasi']?></td>
                        <td><?= $d['organisasi_kode']['organisasi_kode']?></td>
                        <td>
                          <div class="dropdown">
                              <a class="dropdown-item waves-effect" href="<?= site_url('superadmin/tentang-kami/edit/')?><?=$d['id_tentang_kami']?>"><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                             <?php } ?>

                </div>
              </div>

          
              <!--/ Responsive Table -->
            </div>

<?= $this->endSection() ?>