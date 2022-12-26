structure

admin
- id_admin
- username
- password

user
- id_user
- nama_lengkap
- username
- email
- password
- no_hp
- alamat
- kode_pos
- pekerjaan
- status
- saldo

sumber_pemasukan
- id_sumber
- nama

pemasukan
- id_pemasukan
- id_user
- tgl_pemasukan
- jumlah
- id_sumber

jenis_pengeluaran
- id_jenis
- nama

pengeluaran
- id_pengeluaran
- id_user
- tgl_pengeluaran
- jumlah
- id_jenis

generate sql from structure

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kode_pos` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
    `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `sumber_pemasukan` (
  `id_sumber` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pemasukan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_sumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `jenis_pengeluaran` (
  `id_jenis` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

ALTER TABLE `user`
    ADD PRIMARY KEY (`id_user`);

ALTER TABLE `sumber_pemasukan`
    ADD PRIMARY KEY (`id_sumber`);

ALTER TABLE `pemasukan`
    ADD PRIMARY KEY (`id_pemasukan`);

ALTER TABLE `jenis_pengeluaran`
    ADD PRIMARY KEY (`id_jenis`);

ALTER TABLE `pengeluaran`
    ADD PRIMARY KEY (`id_pengeluaran`);

ALTER TABLE `pemasukan`
    ADD KEY `id_user` (`id_user`),
    ADD KEY `id_sumber` (`id_sumber`);

ALTER TABLE `pengeluaran`
    ADD KEY `id_user` (`id_user`),
    ADD KEY `id_jenis` (`id_jenis`);

ALTER TABLE `pemasukan`
    ADD CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
    ADD CONSTRAINT `pemasukan_ibfk_2` FOREIGN KEY (`id_sumber`) REFERENCES `sumber_pemasukan` (`id_sumber`);

ALTER TABLE `pengeluaran`
    ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
    ADD CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_pengeluaran` (`id_jenis`);