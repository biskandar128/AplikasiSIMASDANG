<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales Cards  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div
                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                    >
                    Produk
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?= $totalProduct; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div>        
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-secondary shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div
                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                    >
                    Pemesanan (Menunggu)
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?= $waiting; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-success shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div
                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                    >
                    Pemesanan (Proses)
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?= $process; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-info shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div
                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                    >
                    Pemesanan (Dikirim)
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?= $shipping; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-info shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div
                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                    >
                    Pemesanan (Batal)
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?= $cancel; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-info shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div
                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                    >
                    Pemesanan (Selesai)
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?= $finish; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>