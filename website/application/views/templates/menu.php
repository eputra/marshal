<div class="menu">
	<ul>
		<li style="float:left"><b>Marshal</b></li>
		<li><a href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
		<li class="<?php if($this->uri->segment(1)=="pengaturan"){echo "active";} ?>">
			<a href="<?php echo base_url('pengaturan'); ?>">Pengaturan</a>
		</li>
		<!-- <li class="<?php if($this->uri->segment(1)=="lapang"){echo "active";} ?>">
			<a href="<?php echo base_url('lapang'); ?>">Lapang</a>
		</li> -->
		<!-- <li class="<?php if($this->uri->segment(1)=="blokir"){echo "active";} ?>">
			<a href="<?php echo base_url('blokir'); ?>">Blokir</a>
		</li> -->
		<li class="<?php if($this->uri->segment(1)=="pelanggan"){echo "active";} ?>">
			<a href="<?php echo base_url('pelanggan/pelanggan'); ?>">Pelanggan</a>
		</li>
		<!-- <li class="<?php if($this->uri->segment(1)=="batal"){echo "active";} ?>">
			<a href="<?php echo base_url('batal'); ?>">Batal</a>
		</li> -->
		<!-- <li class="<?php if($this->uri->segment(1)=="bayar"){echo "active";} ?>">
			<a href="<?php echo base_url('bayar'); ?>">Bayar</a>
		</li> -->
		<li class="<?php if($this->uri->segment(1)=="lawan"){echo "active";} ?>">
			<a href="<?php echo base_url('lawan/tunggu'); ?>">Lawan</a>
		</li>
		<li class="<?php if($this->uri->segment(1)=="pesanan"){echo "active";} ?>">
			<a href="<?php echo base_url('pesanan/tunggu'); ?>">Pesanan</a>
		</li>
	</ul>
</div>
<div class="konten">
	<h1><?php echo $title; ?></h1>
	<hr>