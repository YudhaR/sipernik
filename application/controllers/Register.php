<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_surat', 'persuratan');
		$this->load->model('M_referensi', 'referensi');
		if ($this->session->userdata('sess_is_logged_in') == FALSE) {
			redirect('login');
		}
	}

	function getNoSurat()
	{

		$format = $_GET["format"];

		$res = $this->persuratan->get_last_nomor_surat($format);
		$res = $res + 1;

		header("Content-Type: application/json");
		echo json_encode(['res' => $res]);
		exit();
	}

	function surat($alur, $act = NULL, $enc = NULL, $act_extra = NULL, $enc_extra = NULL)
	{
		$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
		$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
		if ($enc != NULL || $enc != "0") {
			$surat_id = $this->encrypt->decode(base64_decode($enc));
		} else {
			$surat_id = NULL;
		}
		$format = $this->referensi->tampil_penomoran()->result_object();
		$data['format_nomor_surat'] = $format[0]->format_nomor_agenda;
		$data['alur']				= $alur;


		if ($alur == "keluar") {
			$data['terima_kirim'] = 'Kirim';
			$format_agenda = $this->referensi->tampil_agenda(2)->result_object();
			$jabatan = $this->persuratan->get_format_jabatan()->result();
			foreach ($jabatan as $j) {
				if ($act == strtolower($j->jabatan)) {
					$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
					$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
					$data['data'] = $this->persuratan->get_surat_posisi($j->id);
					$data['title'] = $j->jabatan;
					$data['page'] = 'admin/surat/list_surat';
					$this->load->vars($data);
					$this->load->view('pages/pages');
				}
			}
		} else {
			$data['terima_kirim'] = 'Terima';
			$format_agenda = $this->referensi->tampil_agenda(1)->result_object();
		}

		if ($act == NULL || $act == "0" || empty($act)) {
			$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
			$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
			$data['data'] = $this->persuratan->surat($alur, $surat_id, $act_extra);
			// $data['data']= $this->persuratan->get_surat_posisi(1);
			$data['page'] = 'admin/surat/list_surat';
			$data['act'] = $alur;

			$this->load->vars($data);
			$this->load->view('pages/pages');
		} elseif ($act == 'hrs_disposisi' && !empty($act)) {
			$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
			$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
			$data['data'] = $this->persuratan->harus_disposisi($alur, $surat_id, $act_extra);
			$data['page'] = 'admin/surat/list_surat';
			$this->load->vars($data);
			$this->load->view('pages/pages');
		} elseif ($act == 'kategori' && !empty($act)) {
			$surat = $this->persuratan->tampil_surat_kategori($enc);
			$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
			$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
			$data['data'] = $surat;
			$data['title'] = $surat->result()[0]->kategori;
			$data['page'] = 'admin/surat/list_surat';
			$this->load->vars($data);
			$this->load->view('pages/pages');
		} else {
			$this->load->model('M_system', 'system');
			$data	= $this->system->konfigurasi_instansi()->result_object();
			if ($alur == "keluar") {
				$data['jenis_surat'] = $this->persuratan->get_jenis_surat();
			} elseif ($alur == "masuk") {
				$data['sifat_surat'] = $this->persuratan->get_sifat_surat();
			}
			$data['alur']				= $alur;
			if ($act == "tambah") {
				$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
				$last_id = $this->persuratan->get_last_agenda_id($alur, '');
				// $last_nomor= $this->persuratan->get_last_nomor_surat(1);
				$data['no_agenda']		= $last_id[0]->last_id + 1;
				$data['surat_id']			= '';
				$data['tgl_terima']			= date("d/m/Y");
				if ($alur == "keluar") {
					$data['tgl_kirim']			= date("d/m/Y");
					$data['ekspedisi']			= '-1';
					$data['format_nomor_surat_id'] = '';
					$data['no_surat']			= '';
					$data['untuk']				= '';
					$data['pengirim']			= $data[0]->kode_pn;
					$data['jenis_id']			= '';
				} elseif ($alur == "masuk") {
					$data['no_surat']			= '';
					$data['untuk']				= 'Ketua ' . $data[0]->kode_pn;
					$data['pengirim']			= '';
					$data['sifat_id']			= '';
					$data['status_id']			= '';
					$data['jenis_surat_masuk_id']			= '';
				}
				// $data['balasan']			='-';
				$data['format_surat']		= '';
				$data['kategori_id']			= '';
				$data['tgl_surat']			= date("d/m/Y");
				$data['file_name']			= '';
				$data['perihal']			= '';
				$data['ket']             	= '';
				$data['act']				= "insert";
				$data['enc']				= '';
				$data['status']				= 0;
				$data['page']				= "admin/surat/act_surat";
				$data['title']				= strtoupper("Tambah Surat " . $alur);
				$data['format_nomor_agenda'] = $format_agenda[0]->format_nomor_agenda;
				$this->load->vars($data);
				$this->load->view('pages/pages');
			} else if ($act == "edit") {
				$row = $this->persuratan->surat_baru($alur, $surat_id)->result();
				$row_masuk = $this->persuratan->surat($alur, $surat_id)->result();
				$no_surat = explode("/", $row[0]->no_surat);
				$format_no_surat_id = $row[0]->format_no_surat_id;
				$kategori_id = $row[0]->kategori_id;
				$q = $this->db->query("SELECT jabatan FROM format_nomor_surat WHERE id=$format_no_surat_id");
				$jabatan = $q->result();
				$k = $this->db->query("SELECT kategori FROM ctr_kategori_surat WHERE id_kategori=$kategori_id");
				$kategori = $k->result();
				
				if ($alur == "keluar") {
					$data['tgl_kirim']			= $row[0]->tgl_kirim;
					$data['ekspedisi']			= $row[0]->ekspedisi;
					$data['no_surat']			= $no_surat[0];
					$data['kategori']			= $kategori[0]->kategori;
					$data['jabatan']			= $jabatan[0]->jabatan;
					$data['format_surat']		= $row[0]->no_surat;
					$data['no_agenda']			= $row[0]->surat_id;
				// $data['balasan']			= $row[0]->balasan;
					$data['jenis_id']			= $row[0]->jenis_id;
					$data['kategori_id']		= $row[0]->kategori_id;
					$data['tgl_surat']			= $this->tanggalhelper->convertToInputDate($row[0]->tgl_surat);
					$data['tgl_terima']			= $this->tanggalhelper->convertToInputDate($row[0]->tgl_terima);
					$data['pengirim']			= $row[0]->pengirim;
					$data['untuk']				= $row[0]->untuk;
					$data['file_name']			= $row[0]->file_name;
					$data['perihal']			= $row[0]->perihal;
					$data['ket']             	= $row[0]->ket;
					$data['status']             = $row[0]->status_disposisi;
					$format_id = $this->persuratan->cek_ref_format_surat($row[0]->format_nomor_id, 1)->result();
					$data['format_surat_id'] 	= $format_id[0]->format_penomoran;
					$data['format_surat_id'] 	= '';
				} elseif ($alur == "masuk") {
					$data['no_surat']			= $row_masuk[0]->no_surat;
					$data['format_surat']		= '';
					$data['format_surat_id'] 	= '';
					$data['no_agenda']			= $row_masuk[0]->surat_id;
					// $data['balasan']			= $row_masuk[0]->balasan;
					$data['sifat_id']			= $row_masuk[0]->sifat_id;
					$data['status_id']			= $row_masuk[0]->status_id;
					$data['jenis_surat_masuk_id']= $row_masuk[0]->jenis_surat_masuk_id;
					$data['kategori_id']			= $row_masuk[0]->kategori_id;
					$data['tgl_surat']			= $this->tanggalhelper->convertToInputDate($row_masuk[0]->tgl_surat);
					$data['tgl_terima']			= $this->tanggalhelper->convertToInputDate($row_masuk[0]->tgl_terima);
					$data['pengirim']			= $row_masuk[0]->pengirim;
					$data['untuk']				= $row_masuk[0]->untuk;
					$data['file_name']			= $row_masuk[0]->file_name;
					$data['perihal']			= $row_masuk[0]->perihal;
					$data['ket']             	= $row_masuk[0]->ket;
					$data['status']             = $row_masuk[0]->status_disposisi;
				}
				
				$data['enc']				= $enc;
				$data['act']				= "edit";
				$data['page']				= "admin/surat/act_surat";
				$data['title']				= strtoupper("Edit Surat " . $alur);
				$data['format_nomor_agenda'] = $format_agenda[0]->format_nomor_agenda;
				$this->load->vars($data);
				$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
				$this->load->view('pages/pages');
			} elseif ($act == "tambah_surat_lama") {
				$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
				$last_id = $this->persuratan->get_last_agenda_id($alur, '');
				$data['no_agenda']		= $last_id[0]->last_id + 1;
				$data['surat_id']			= '';
				$data['tgl_terima']			= date("d/m/Y");
				if ($alur == "keluar") {
					$data['tgl_kirim']			= date("d/m/Y");
					$data['ekspedisi']			= '-1';
					$data['no_surat']			= $last_id[0]->last_id + 1;;
					$data['untuk']				= '';
					$data['pengirim']			= $data[0]->kode_pn;
					$data['jenis_id']			= '';
				} elseif ($alur == "masuk") {
					$data['no_surat']			= '';
					$data['untuk']				= 'Ketua ' . $data[0]->kode_pn;
					$data['pengirim']			= '';
					$data['sifat_id']			= '';
					$data['status_id']			= '';
					$data['jenis_surat_masuk_id']			= '';
				}
				// $data['balasan']			='-';
				$data['format_surat']		= '';
				$data['tgl_surat']			= date("d/m/Y");
				$data['file_name']			= '';
				$data['perihal']			= '';
				$data['ket']             	= '';
				$data['act']				= "insert_surat_lama";
				$data['enc']				= '';
				$data['status']				= 0;
				$data['page']				= "admin/surat/act_surat_lama";
				$data['title']				= strtoupper("Tambah Surat " . $alur);
				$data['format_nomor_agenda'] = $format_agenda[0]->format_nomor_agenda;
				$this->load->vars($data);
				$this->load->view('pages/pages');
			} elseif ($act == "edit_surat_lama") {
				$row = $this->persuratan->surat($alur, $surat_id)->result();
				if ($alur == "keluar") {
					$data['tgl_kirim']			= $row[0]->tgl_kirim;
					$data['ekspedisi']			= $row[0]->ekspedisi;
					$data['no_surat']			= $row[0]->surat_id;
					$data['format_surat']		= $row[0]->no_surat;
					$data['jenis_id']			= $row[0]->jenis_id;
					$format_id = $this->persuratan->cek_ref_format_surat($row[0]->format_nomor_id, 1)->result();
					// $data['format_surat_id'] 	= $format_id[0]->format_penomoran;
					$data['format_surat_id'] 	= '';
				} elseif ($alur == "masuk") {
					$data['no_surat']			= $row[0]->no_surat;
					$data['format_surat']		= '';
					$data['format_surat_id'] 	= '';
					$data['sifat_id']			= $row[0]->sifat_id;
					$data['status_id']			= $row[0]->status_id;
					$data['jenis_surat_masuk_id']= $row[0]->jenis_surat_masuk_id;
				}
				$data['no_agenda']			= $row[0]->surat_id;
				// $data['balasan']			= $row[0]->balasan;
				$data['tgl_surat']			= $this->tanggalhelper->convertToInputDate($row[0]->tgl_surat);
				$data['tgl_terima']			= $this->tanggalhelper->convertToInputDate($row[0]->tgl_terima);
				$data['pengirim']			= $row[0]->pengirim;
				$data['untuk']				= $row[0]->untuk;
				$data['file_name']			= $row[0]->file_name;
				$data['perihal']			= $row[0]->perihal;
				$data['ket']             	= $row[0]->ket;
				$data['status']             = $row[0]->status_disposisi;
				$data['enc']				= $enc;
				$data['act']				= "edit_surat_lama";
				$data['page']				= "admin/surat/act_surat_lama";
				$data['title']				= strtoupper("Edit Surat " . $alur);
				$data['format_nomor_agenda'] = $format_agenda[0]->format_nomor_agenda;
				$this->load->vars($data);
				$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
				$this->load->view('pages/pages');
			} else if ($act == "popup_cetak") {
				$data['dari']			= date("d/m/Y");
				$data['sampai']			= date("d/m/Y");
				if ($alur == "keluar") {
					$data['jenis_surat'] = $this->persuratan->get_jenis_surat()->result();
				} elseif ($alur == "masuk") {
					$data['sifat_surat'] = $this->persuratan->get_sifat_surat()->result();
				}
				$data['tahun']			= $this->persuratan->get_tahun($alur)->result();
				$data['act']			= "cetak_agenda";
				$data['title']			= strtoupper("CETAK BUKU AGENDA - SURAT " . $alur);
				$this->load->view('admin/surat/act_cetak_surat', $data);
			} else if ($act == "cetak_agenda") {
				$alur = $this->input->post('alur', TRUE);
				$jenis_cetak = $this->input->post('jenis_cetak', TRUE);
				$bulan = $this->input->post('bulan', TRUE);
				$tahun = $this->input->post('tahun', TRUE);
				if ($alur == "keluar") {
					$jenis_surat = $this->input->post('jenis_surat', TRUE);
				} elseif ($alur == "masuk") {
					$sifat_surat = $this->input->post('sifat_surat', TRUE);
				}
				$mulai = $this->tanggalhelper->convertToMysqlDate($this->input->post('dari', TRUE));
				$sampai = $this->tanggalhelper->convertToMysqlDate($this->input->post('sampai', TRUE));

				switch ($jenis_cetak) {
					case '1':
						$data['data']	= $this->persuratan->tampil_agenda($alur, $jenis_cetak, $mulai, $sampai)->result_object();
						$data['jenis'] = "Berdasarkan Tanggal Surat \\par Dari Tanggal : \\b " . tgl_indo($mulai) . " " . "\\b0  Sampai dengan Tanggal : \\b " . tgl_indo($sampai) . '\\b0';
						$data['file_name'] = "pertanggal";
						break;
					case '2':
						$data['data']	= $this->persuratan->tampil_agenda($alur, $jenis_cetak, "", "", $bulan, $tahun)->result_object();
						$data['jenis'] = "Berdasarkan Bulan : " . $this->tanggalhelper->getBulanFull($bulan) . " " . $tahun;
						$data['file_name'] = "perbulan";
						break;
					case '3':
						$data['data']	= $this->persuratan->tampil_agenda($alur, $jenis_cetak, "", "", "", $tahun)->result_object();
						$data['jenis'] = "Berdasarkan Tahun " . $tahun;
						$data['file_name'] = "pertahun";
						break;
					case '4':
						if ($alur == "keluar") {
							$jenis_surat_nama = $this->persuratan->get_jenis_surat($jenis_surat)->result_object();
							$data['data']	= $this->persuratan->tampil_agenda($alur, $jenis_cetak, "", "", "", $tahun, $jenis_surat)->result_object();
							$data['jenis'] = "Berdasarkan Jenis Surat " . $jenis_surat_nama[0]->nama;
							$data['file_name'] = "jenissurat";
						} elseif ($alur == "masuk") {
							$sifat_surat_nama = $this->persuratan->get_sifat_surat($sifat_surat)->result_object();
							$data['data']	= $this->persuratan->tampil_agenda($alur, $jenis_cetak, "", "", "", $tahun,  "",$sifat_surat)->result_object();
							$data['sifat'] = "Berdasarkan Sifat Surat " . $sifat_surat_nama[0]->nama;
							$data['file_name'] = "sifatsurat";
						}
						break;
					default:
						$data['data']	= $this->persuratan->tampil_agenda($alur, $jenis_cetak, "", "", "", $tahun)->result_object();
						$data['jenis'] = "Berdasarkan Tahun " . $tahun;
						$data['file_name'] = "pertahun";
						break;
				}
				$data['laporan'] = TRUE;
				$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
				$this->load->view('admin/surat/cetak_agenda', $data);
			} else if ($act == "disposisi") {
				$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
				if ($act_extra == NULL) {
					if ($alur == "keluar") {
						$row = $this->persuratan->surat_baru($alur, $surat_id)->result();
						$data['jabatan']		= $row[0]->jabatan;
						$data['kategori']		= $row[0]->kategori;
					} else {
						$row = $this->persuratan->surat($alur, $surat_id)->result();
					}
					$data['list_disposisi']		= $this->persuratan->get_disposisi($surat_id);
					$nama_file_qr = preg_replace('/[^a-zA-Z0-9_.]/', '', $row[0]->no_agenda);
					$qrLink = $this->generate_qr->qr_code(base_url() . "Qrscan/st/disposisi/" . $surat_id, "disposisi_" . $nama_file_qr);
					$data['pictQR'] = $qrLink[0];
					$data['no_agenda']			= $row[0]->no_agenda;
					// $data['balasan']			= $row[0]->balasan;
					$data['kode']				= $row[0]->kode;
					$data['nama']				= $row[0]->nama;
					$data['no_surat']			= $row[0]->no_surat;
					$data['tgl_surat']			= tgl_indo($row[0]->tgl_surat);
					$data['tgl_terima']			= tgl_indo($row[0]->tgl_terima);
					$data['pengirim']			= $row[0]->pengirim;
					if ($alur == "keluar") {
						$data['tgl_kirim']			= tgl_indo($row[0]->tgl_kirim);
						$data['ekspedisi_nama']			= $row[0]->ekspedisi_nama;
					}
					$data['untuk']				= $row[0]->untuk;

					$data['file_name']			= $row[0]->file_name;
					$data['perihal']			= $row[0]->perihal;
					$data['ket']             	= $row[0]->ket;
					$data['enc']				= $enc;
					if ($alur == 'masuk') {
						$data['title']				= "DIPSOSISI SURAT NOMOR " . $row[0]->no_surat;
						$data['status']				= $row[0]->status;
						$data['jenis']				= $row[0]->jenis;
					} else {
						$data['title']				= "DETIL SURAT NOMOR " . $row[0]->no_surat;
					}
					$data['page'] = 'admin/surat/list_disposisi';
					$this->load->vars($data);
					$this->load->view('pages/pages');
				} else if ($act_extra == "tambah") {
					$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
					$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
					$row = $this->persuratan->surat($alur, $surat_id)->result();
					$data['jabatan'] = $this->persuratan->get_jabatan();
					$data['petunjuk_disposisi'] = $this->persuratan->get_petunjuk_disposisi();
					$data['tgl_disposisi']			= date("d/m/Y");
					$data['catatan']			= "";
					$data['enc']				= $enc;
					$data['enc_disposisi']		= '';
					$data['act']				= "insert";
					$data['page']				= "act_disposisi";
					$data['title']				= "TAMBAH DIPSOSISI SURAT NOMOR " . $row[0]->no_surat;
					$this->load->vars($data);
					$this->load->view('admin/surat/act_disposisi');
				} else if ($act_extra == "diterima") {
					$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
					$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
					$row = $this->persuratan->surat($alur, $surat_id)->result();
					$data['jabatan'] = $this->persuratan->get_jabatan();
					$data['petunjuk_disposisi'] = $this->persuratan->get_petunjuk_disposisi();
					$data['tgl_disposisi']			= date("d/m/Y");
					$data['catatan']			= "";
					$data['enc']				= $enc;
					$data['enc_disposisi']		= '';
					$data['act']				= "insert";
					$data['page']				= "act_diterima";
					$data['title']				= "DITERIMA SURAT NOMOR " . $row[0]->no_surat;
					$this->load->vars($data);
					$this->load->view('admin/surat/act_diterima');
				} else if ($act_extra == "edit") {
					$disposisi_id = $this->encrypt->decode(base64_decode($enc_extra));
					$row = $this->persuratan->surat($alur, $surat_id)->result();
					$disposisi = $this->persuratan->get_disposisi($surat_id, $disposisi_id)->result();
					$data['jabatan'] = $this->persuratan->get_jabatan();
					$data['dari'] = $disposisi[0]->dari;
					$data['kepada'] = $disposisi[0]->kepada;
					$data['petunjuk_disposisi'] = $this->persuratan->get_petunjuk_disposisi();
					$data['tgl_disposisi']			= $this->tanggalhelper->convertToInputDate($disposisi[0]->tgl_disposisi);
					$data['catatan']			= $disposisi[0]->catatan;
					$data['enc_disposisi']		= base64_encode($this->encrypt->encode($disposisi[0]->id));
					$data['enc']				= $enc;
					$data['act']				= "update";
					$data['page']				= "act_disposisi";
					$data['title']				= "EDIT DIPSOSISI SURAT NOMOR " . $row[0]->no_surat;
					$this->load->vars($data);
					$this->load->view('admin/surat/act_disposisi');
				} else if ($act_extra == "preview") {
					if ($alur == "masuk") {
						$surat	= $this->persuratan->surat($alur, $surat_id)->result_object();
						$a['sifat_surat'] = $surat[0]->kode . '/' . $surat[0]->nama;
					} else {
						$surat	= $this->persuratan->surat_baru($alur, $surat_id)->result_object();
						$a['kategori_surat'] = $surat[0]->kategori;
						$a['jenis_surat'] = $surat[0]->kode . '/' . $surat[0]->nama;
					}
					$a['data']	= $this->persuratan->get_disposisi($surat_id)->result_object();
					$a['no_agenda'] = $surat[0]->no_agenda;
					$a['no_surat'] = $surat[0]->no_surat;
					// $a['balasan'] = $surat[0]->balasan;
					$a['tgl_surat'] = tgl_indo($surat[0]->tgl_surat);
					$a['tgl_terima_kirim'] = tgl_indo($surat[0]->tgl_terima);
					$a['kode'] = ucwords($surat[0]->kode);
					$a['nama'] = ucwords($surat[0]->nama);
					$a['pengirim'] = ucwords($surat[0]->pengirim);
					$a['untuk'] = ucwords($surat[0]->untuk);
					$a['file_name'] = $surat[0]->file_name;
					$a['perihal'] = ucfirst($surat[0]->perihal);
					$a['ket'] = ucfirst($surat[0]->ket);
					$nama_file_qr = preg_replace('/[^a-zA-Z0-9_.]/', '', $surat[0]->no_agenda);
					$qrLink = $this->generate_qr->qr_code(base_url() . "Qrscan/st/disposisi/" . $surat_id, "disposisi_" . $nama_file_qr);
					$a['pictQR'] = $qrLink[0];
					$a['page']				= "preview_disposisi";
					$a['title']				= "PREVIEW LEMBAR DISPOSISI";
					$this->load->view('admin/surat/preview_disposisi', $a);
				} else if ($act_extra == "preview_kosong") {
					if ($alur == "masuk") {
						$surat	= $this->persuratan->surat($alur, $surat_id)->result_object();
						$a['sifat_surat'] = $surat[0]->kode . '/' . $surat[0]->nama;
					} else {
						$surat	= $this->persuratan->surat_baru($alur, $surat_id)->result_object();
						$a['kategori_surat'] = $surat[0]->kategori;
						$a['jenis_surat'] = $surat[0]->kode . '/' . $surat[0]->nama;
					}
					$a['alur'] = $alur;
					$a['data']	= $this->persuratan->get_disposisi('-1')->result_object();
					$a['no_agenda'] = $surat[0]->no_agenda;
					$a['no_surat'] = $surat[0]->no_surat;
					// $a['balasan'] = $surat[0]->balasan;
					$a['tgl_surat'] = tgl_indo($surat[0]->tgl_surat);
					$a['tgl_terima_kirim'] = tgl_indo($surat[0]->tgl_terima);
					$a['kode'] = ucwords($surat[0]->kode);
					$a['nama'] = ucwords($surat[0]->nama);
					$a['pengirim'] = ucwords($surat[0]->pengirim);
					$a['untuk'] = ucwords($surat[0]->untuk);
					$a['file_name'] = $surat[0]->file_name;
					$a['perihal'] = ucfirst($surat[0]->perihal);
					$a['ket'] = ucfirst($surat[0]->ket);
					$nama_file_qr = preg_replace('/[^a-zA-Z0-9_.]/', '', $surat[0]->no_agenda);
					$qrLink = $this->generate_qr->qr_code(base_url() . "Qrscan/st/disposisi/" . $surat_id, "disposisi_" . $nama_file_qr);
					$a['pictQR'] = $qrLink[0];
					$a['page']				= "preview_disposisi";
					$a['title']				= "PREVIEW LEMBAR DISPOSISI";
					$this->load->view('admin/surat/preview_disposisi', $a);
				}
			} else if ($act == "ordner") {
				$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
				$data['alur'] = $alur;
				if ($act_extra == NULL) {
					$data['data']	= $this->persuratan->tampil_ordner()->result_object();
					$data['page'] = 'admin/surat/list_ordner';
					$this->load->vars($data);
					$this->load->view('pages/pages');
				} else if ($act_extra == "tambah") {
					$data['data']	= $this->persuratan->tampil_ordner($surat_id)->result();
					$data['enc_ordner']			= $enc;
					$data['enc_ordner']			= "1";
					$data['enc_surat']			= base64_encode($this->encrypt->encode($surat_id));
					$data['act']				= "insert";
					$data['page']				= "act_ordner";
					$data['title']				= "SIMPAN KEDALAM ORDNER / BOX";
					$this->load->vars($data);
					$this->load->view('admin/surat/act_ordner');
				} else if ($act_extra == "edit") {
					$data['data']	= $this->persuratan->tampil_ordner($surat_id)->result();
					$data['enc_ordner']			= $enc;
					$data['enc_ordner']			= base64_encode($this->encrypt->encode($data['data'][0]->ordner_id));
					$data['enc_surat']			= base64_encode($this->encrypt->encode($surat_id));
					$data['act']				= "update";
					$data['page']				= "act_ordner";
					$data['title']				= "EDIT SURAT DI ORDNER / BOX";
					$this->load->vars($data);
					$this->load->view('admin/surat/act_ordner');
				}
			} else if ($act == "draft_surat") {
				$last_id = $this->persuratan->get_last_agenda_id($alur, '');
				$data['no_agenda']		= $last_id[0]->last_id + 1;
				$data['surat_id']			= '';
				$data['tgl_terima']			= date("d/m/Y");
				if ($alur == "keluar") {
					$data['tgl_kirim']			= date("d/m/Y");
					$data['ekspedisi']			= '-1';
					$data['jenis_id']			= '';
				} else if ($alur == "masuk") {
					$data['sifat_id']			= '';
					$data['status_id']			= '';
					$data['jenis_surat_masuk_id']			= '';
				}
				$data['kepada']			= '';
				$data['no_surat']			= '';
				$data['kategori_id']			= '';
				$data['tgl_surat']			= date("d/m/Y");
				$data['pengirim']			= '';
				$data['file_name']			= '';
				$data['untuk']				= '';
				$data['perihal']			= '';
				$data['ket']             	= '';
				$data['act']				= "insert";
				$data['enc']				= '';
				$data['status']				= 0;
				$data['page']				= "admin/surat/draft_surat";
				$data['title']				= 'DRAFT SURAT';
				$this->load->vars($data);
				$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
				$this->load->view('pages/pages');
			} else if ($act == "detil") {
				$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
				$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();

				$row = $this->persuratan->surat($alur, $surat_id)->result();
				$data['jabatan']		= $row[0]->jabatan;
				$data['kategori']		= $row[0]->kategori;

				$data['list_disposisi']		= $this->persuratan->get_disposisi($surat_id);
				$nama_file_qr = preg_replace('/[^a-zA-Z0-9_.]/', '', $row[0]->no_agenda);
				$qrLink = $this->generate_qr->qr_code(base_url() . "Qrscan/st/disposisi/" . $surat_id, "disposisi_" . $nama_file_qr);
				$data['pictQR'] = $qrLink[0];
				$data['no_agenda']			= $row[0]->no_agenda;
				// $data['balasan']			= $row[0]->balasan;
				$data['kode']				= $row[0]->kode;
				$data['nama']				= $row[0]->nama;
				$data['no_surat']			= $row[0]->no_surat;
				$data['tgl_surat']			= tgl_indo($row[0]->tgl_surat);
				$data['tgl_terima']			= tgl_indo($row[0]->tgl_terima);
				$data['pengirim']			= $row[0]->pengirim;
				if ($alur == "keluar") {
					$data['tgl_kirim']			= tgl_indo($row[0]->tgl_kirim);
					$data['ekspedisi_nama']			= $row[0]->ekspedisi_nama;
				}
				$data['untuk']				= $row[0]->untuk;

				$data['file_name']			= $row[0]->file_name;
				$data['perihal']			= $row[0]->perihal;
				$data['ket']             	= $row[0]->ket;
				$data['enc']				= $enc;
				if ($alur == 'masuk') {
					$data['title']				= "DIPSOSISI SURAT NOMOR " . $row[0]->no_surat;
					$data['status']				= $row[0]->status;
					$data['jenis']				= $row[0]->jenis;
				} else {
					$data['title']				= "DETIL SURAT NOMOR " . $row[0]->no_surat;
				}
				$data['page'] = 'admin/surat/list_disposisi';
				$this->load->vars($data);
				$this->load->view('pages/pages');
			}
		}
	}

	function validate_input($alur, $act = NULL, $enc = NULL)
	{
		$no_urut = $this->input->post('no_agenda', TRUE);
		$no_agenda = $this->input->post('format_nomor_agenda', TRUE);
		$tgl_terima = $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_terima', TRUE));
		$tgl_kirim = $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_kirim', TRUE));
		$ekspedisi = $this->input->post('ekspedisi', TRUE);
		if ($alur == "masuk") {
			$sifat_id = $this->input->post('sifat_surat', TRUE);
			$status_id = $this->input->post('status_surat', TRUE);
			$jenis_surat_masuk_id = $this->input->post('jenis_surat_masuk', TRUE);
		} else if ($alur == "keluar") {
			$jenis_id = $this->input->post('jenis_surat', TRUE);
		}
		$kategori_id = $this->input->post('kategori_surat', TRUE);
		$format_nomor = $this->input->post('format_kode', TRUE);
		$format_no_surat_id = $this->input->post('format_nomor_surat_id', TRUE);
		$format_id = $this->persuratan->cek_ref_format_surat($format_nomor, 2)->result();
		if ($alur == 'keluar') {
			$no_surat = $this->input->post('format_nomor_surat', TRUE);
		} elseif ($alur == 'masuk') {
			$no_surat = $this->input->post('no_surat', TRUE);
		}
		$tgl_surat = $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_surat', TRUE));
		// $balasan=$this->input->post('balasan',TRUE);	
		$pengirim = $this->input->post('pengirim', TRUE);
		$untuk = $this->input->post('untuk', TRUE);
		$perihal = $this->input->post('perihal', TRUE);
		$enc = $this->input->post('enc', TRUE);
		$ada_file = $this->input->post('ada_file', TRUE);
		$ket = $this->input->post('ket', TRUE);
		$status = $this->input->post('status', TRUE);
		if ($enc != NULL) {
			$surat_id = $this->encrypt->decode(base64_decode($enc));
		} else {
			$surat_id = NULL;
		}

		$q = $this->db->query("SELECT jabatan FROM format_nomor_surat WHERE id=$format_no_surat_id");
		$posisi = $q->result();
		if (count($posisi) > 0) {
			$posisi = strtolower($posisi[0]->jabatan);
		}
		$p = $this->db->query("SELECT kategori FROM ctr_kategori_surat WHERE id_kategori=$kategori_id");
		$kategori = $p->result();

		if (count($posisi) > 0) {
			$kategori = $kategori[0]->kategori;
		}


		$this->config_file($alur, $posisi, $kategori);
		if (!$this->upload->do_upload('file_surat')) {
			$data_file = array('upload_data' => $this->upload->data());
			$data = array(
				'no_agenda' => $no_agenda,
				'surat_id' => $no_urut,
				'no_surat' => $no_surat,
				'tgl_surat' => $tgl_surat,
				'tgl_terima' => $tgl_terima,
				'pengirim' => $pengirim,
				'untuk' => $untuk,
				'perihal' => $perihal,
				'status_disposisi' => $status,
				'ket' => $ket,
				'file_name' => $ada_file,
			);
			if ($alur == "keluar") {
				$data['tgl_kirim'] = $tgl_kirim;
				$data['jenis_id'] = $jenis_id;
				$data['ekspedisi'] = $ekspedisi;
				$data['kategori_id'] = $kategori_id;
				$data['format_nomor_id'] = $format_id[0]->id;
				$data['format_no_surat_id'] = $format_no_surat_id;
			} else if ($alur == "masuk"){
				$data['sifat_id'] = $sifat_id;
				$data['status_id'] = $status_id;
				$data['jenis_surat_masuk_id'] = $jenis_surat_masuk_id;
			}
		} else {
			$data_file = array('upload_data' => $this->upload->data());
			$data = array(
				'no_agenda' => $no_agenda,
				'surat_id' => $no_urut,
				'no_surat' => $no_surat,
				'tgl_surat' => $tgl_surat,
				'tgl_terima' => $tgl_terima,
				'pengirim' => $pengirim,
				'untuk' => $untuk,
				'perihal' => $perihal,
				'status_disposisi' => $status,
				'ket' => $ket,
				'file_name' => $data_file['upload_data']['file_name'],
			);
			if ($alur == "keluar") {
				$data['tgl_kirim'] = $tgl_kirim;
				$data['ekspedisi'] = $ekspedisi;
				$data['jenis_id'] = $jenis_id;
				$data['kategori_id'] = $kategori_id;
				$data['format_nomor_id'] = $format_id[0]->id;
				$data['format_no_surat_id'] = $format_no_surat_id;
			} else if ($alur == "masuk"){
				$data['sifat_id'] = $sifat_id;
				$data['status_id'] = $status_id;
				$data['jenis_surat_masuk_id'] = $jenis_surat_masuk_id;
			}
		}




		// print_r($data);
		// die();
		if ($alur == "keluar") {
			if ($act == 'insert') {
				$this->db->insert('ctr_surat_keluar_baru', $data);
			} else if ($act == 'edit') {
				$this->db->where('surat_id', $surat_id);
				$this->db->update('ctr_surat_keluar_baru', $data);
			}
			redirect('Register/surat/keluar/' . $posisi, 'refresh');
		} else {
			if ($act == 'insert') {
				$this->db->insert('ctr_surat_masuk', $data);
			} else if ($act == 'edit') {
				$this->db->where('surat_id', $surat_id);
				$this->db->update('ctr_surat_masuk', $data);
			}
			redirect('Register/surat/masuk', 'refresh');
		}
	}
	function validate_input_lama($alur, $act = NULL, $enc = NULL)
	{
		$no_urut = $this->input->post('no_agenda', TRUE);
		$no_agenda = $this->input->post('format_nomor_agenda', TRUE);
		$tgl_terima = $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_terima', TRUE));
		$tgl_kirim = $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_kirim', TRUE));
		$ekspedisi = $this->input->post('ekspedisi', TRUE);
		if ($alur == "masuk") {
			$sifat_id = $this->input->post('sifat_surat', TRUE);
			$status_id = $this->input->post('status_surat', TRUE);
			$jenis_surat_masuk_id = $this->input->post('jenis_surat_masuk', TRUE);
		} else if ($alur == "keluar") {
			$jenis_id = $this->input->post('jenis_surat', TRUE);
		}
		$format_nomor = $this->input->post('format_nomor', TRUE);
		$format_id = $this->persuratan->cek_ref_format_surat($format_nomor, 2)->result();
		if ($alur == 'keluar') {
			$no_surat = $this->input->post('format_nomor_surat', TRUE);
		} elseif ($alur == 'masuk') {
			$no_surat = $this->input->post('no_surat', TRUE);
		}
		$tgl_surat = $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_surat', TRUE));
		// $balasan=$this->input->post('balasan',TRUE);	
		$pengirim = $this->input->post('pengirim', TRUE);
		$untuk = $this->input->post('untuk', TRUE);
		$perihal = $this->input->post('perihal', TRUE);
		$enc = $this->input->post('enc', TRUE);
		$ada_file = $this->input->post('ada_file', TRUE);
		$ket = $this->input->post('ket', TRUE);
		$status = $this->input->post('status', TRUE);
		if ($enc != NULL) {
			$surat_id = $this->encrypt->decode(base64_decode($enc));
		} else {
			$surat_id = NULL;
		}

		$this->config_file($alur);
		if (!$this->upload->do_upload('file_surat')) {
			$data_file = array('upload_data' => $this->upload->data());
			$data = array(
				'no_agenda' => $no_agenda,
				'surat_id' => $no_urut,
				'no_surat' => $no_surat,
				'tgl_surat' => $tgl_surat,
				'tgl_terima' => $tgl_terima,
				'pengirim' => $pengirim,
				'untuk' => $untuk,
				'perihal' => $perihal,
				'status_disposisi' => $status,
				'ket' => $ket,
				'file_name' => $ada_file,
			);
			if ($alur == "keluar") {
				$data['tgl_kirim'] = $tgl_kirim;
				$data['ekspedisi'] = $ekspedisi;
				$data['jenis_id'] = $jenis_id;
				$data['format_nomor_id'] = $format_id[0]->id;
			} else if ($alur == "masuk"){
				$data['sifat_id'] = $sifat_id;
				$data['status_id'] = $status_id;
				$data['jenis_surat_masuk_id'] = $jenis_surat_masuk_id;
			}
		} else {
			$data_file = array('upload_data' => $this->upload->data());
			$data = array(
				'no_agenda' => $no_agenda,
				'surat_id' => $no_urut,
				'no_surat' => $no_surat,
				'tgl_surat' => $tgl_surat,
				'tgl_terima' => $tgl_terima,
				'pengirim' => $pengirim,
				'untuk' => $untuk,
				'perihal' => $perihal,
				'status_disposisi' => $status,
				'ket' => $ket,
				'file_name' => $data_file['upload_data']['file_name'],
			);
			if ($alur == "keluar") {
				$data['tgl_kirim'] = $tgl_kirim;
				$data['ekspedisi'] = $ekspedisi;
				$data['jenis_id'] = $jenis_id;
				$data['format_nomor_id'] = $format_id[0]->id;
			} else if ($alur == "masuk"){
				$data['sifat_id'] = $sifat_id;
				$data['status_id'] = $status_id;
				$data['jenis_surat_masuk_id'] = $jenis_surat_masuk_id;
			}
		}
		if ($act == 'insert_surat_lama') {
			$this->db->insert('ctr_surat_' . $alur, $data);
		} else if ($act == 'edit_surat_lama') {
			$this->db->where('surat_id', $surat_id);
			$this->db->update('ctr_surat_' . $alur, $data);
		} else if ($act == 'edit') {
			$this->db->where('surat_id', $surat_id);
			$this->db->update('ctr_surat_' . $alur, $data);
		}
		redirect('Register/surat/' . $alur, 'refresh');
	}

	function insert_ordner()
	{
		$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
		$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
		$surat_id = $this->encrypt->decode(base64_decode($this->input->post('surat')));
		$ordner_id = $this->encrypt->decode(base64_decode($this->input->post('ordner')));
		$tgl_ordner = $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_ordner'));
		$object = array(
			'surat_id' => $surat_id,
			'ordner_id' => $ordner_id,
			'tgl_ordner' => $tgl_ordner
		);
		$this->db->insert('ctr_surat_ordner', $object);
		redirect('Register/surat/masuk/ordner/', 'refresh');
	}

	function update_ordner()
	{
		$surat_id = $this->encrypt->decode(base64_decode($this->input->post('surat')));
		$ordner_id = $this->encrypt->decode(base64_decode($this->input->post('ordner')));
		$tgl_ordner = $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_ordner'));
		$object = array(
			'surat_id' => $surat_id,
			'ordner_id' => $ordner_id,
			'tgl_ordner' => $tgl_ordner
		);
		$this->db->where('surat_id', $surat_id);
		$this->db->update('ctr_surat_ordner', $object);
		redirect('Register/surat/masuk/ordner/', 'refresh');
	}

	function insert_disposisi()
	{
		$data['harus_disposisi'] = $this->persuratan->harus_disposisi('masuk')->num_rows();
		$data['belum_disposisi'] = $this->persuratan->belum_disposisi()->num_rows();
		$surat_id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$dari = $this->input->post('dari');
		$kepada = $this->input->post('kepada');
		$tgl_disposisi = $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_disposisi'));
		$catatan = $this->input->post('catatan');
		$petunjuk = $this->input->post('petunjuk');
		$object = array(
			'surat_id' => $surat_id,
			'dari' => $dari,
			'kepada' => $kepada,
			'tgl_disposisi' => $tgl_disposisi,
			'catatan' => $catatan,
			'petunjuk' => $petunjuk,
		);
		$update_surat = array('status_disposisi' => $dari);
		$this->db->insert('ctr_disposisi', $object);
		$this->db->where('surat_id', $surat_id);
		$this->db->update('ctr_surat_masuk', $update_surat);
		redirect('Register/surat/masuk/disposisi/' . $this->input->post('enc'), 'refresh');
	}

	function insert_diterima()
	{

		$surat_id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$dari = $this->input->post('dari');
		$kepada = $this->input->post('dari');
		$tgl_disposisi = $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_diterima'));
		$catatan = $this->input->post('catatan_diterima');
		$petunjuk = 100;
		$object = array(
			'surat_id' => $surat_id,
			'dari' => $dari,
			'kepada' => $kepada,
			'tgl_disposisi' => $tgl_disposisi,
			'catatan' => $catatan,
			'petunjuk' => $petunjuk,
		);
		$update_surat = array('status_diterima' => $dari);
		$update_disposisi = array('status_disposisi' => $dari);
		$this->db->insert('ctr_disposisi', $object);
		$this->db->where('surat_id', $surat_id);
		$this->db->update('ctr_surat_masuk', $update_surat);
		$this->db->update('ctr_surat_masuk', $update_disposisi);
		redirect('Register/surat/masuk/disposisi/' . $this->input->post('enc'), 'refresh');
	}

	function update_disposisi()
	{
		$surat_id = $this->encrypt->decode(base64_decode($this->input->post('enc')));
		$disposisi_id = $this->encrypt->decode(base64_decode($this->input->post('enc_disposisi')));
		$dari = $this->input->post('dari');
		$kepada = $this->input->post('kepada');
		$tgl_disposisi = $this->tanggalhelper->convertToMysqlDate($this->input->post('tgl_disposisi'));
		$catatan = $this->input->post('catatan');
		$petunjuk = $this->input->post('petunjuk');
		$object = array(
			'surat_id' => $surat_id,
			'dari' => $dari,
			'kepada' => $kepada,
			'tgl_disposisi' => $tgl_disposisi,
			'catatan' => $catatan,
			'petunjuk' => $petunjuk,
		);
		$this->db->where('id', $disposisi_id);
		$this->db->update('ctr_disposisi', $object);
		$update_surat = array('status_disposisi' => $dari);
		$this->db->where('surat_id', $surat_id);
		$this->db->update('ctr_surat_masuk', $update_surat);
		redirect('Register/surat/masuk/disposisi/' . $this->input->post('enc'), 'refresh');
	}
	function hapus_surat($alur, $enc)
	{
		$id = $this->encrypt->decode(base64_decode($enc));
		$q = $this->db->query("SELECT format_no_surat_id FROM ctr_surat_keluar_baru WHERE surat_id=$id");
		$format_no_surat_id = $q->result();

		if (count($format_no_surat_id) > 0) {
			$format_no_surat_id = $format_no_surat_id[0]->format_no_surat_id;
		}
		$p = $this->db->query("SELECT jabatan FROM format_nomor_surat WHERE id=$format_no_surat_id");
		$posisi = $p->result();
		if (count($posisi) > 0) {
			$posisi = strtolower($posisi[0]->jabatan);
		}
		// print_r($posisi);
		// 	die();

		if ($alur == "keluar") {
			$this->db->delete('ctr_surat_keluar_baru', array('surat_id' => $id));
			redirect('Register/surat/' . $alur . '/' . $posisi, 'refresh');
		} else {
			$this->db->delete('ctr_surat_masuk', array('surat_id' => $id));
			redirect('Register/surat/' . $alur, 'refresh');
		}
	}

	function hapus_ordner($enc)
	{
		$id = $this->encrypt->decode(base64_decode($enc));
		$this->db->delete('ctr_surat_ordner', array('id' => $id));
		redirect('Register/surat/masuk/ordner/', 'refresh');
	}

	function hapus_disposisi($enc_disposisi, $enc)
	{
		$id = $this->encrypt->decode(base64_decode($enc_disposisi));
		$this->db->delete('ctr_disposisi', array('id' => $id));
		redirect('Register/surat/masuk/disposisi/' . $enc, 'refresh');
	}

	function config_file($alur, $jabatan = NULL, $kategori = NULL)
	{
		if ($alur == "keluar") {
			$config['upload_path'] 		= './upload/surat_' . $alur . '/' . $jabatan . '/' . $kategori;
		} else {
			$config['upload_path'] 		= './upload/surat_' . $alur;
		}
		$config['allowed_types'] 	= 'jpg|png|pdf|doc|docx|rar';
		$config['max_size']			= '80000';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
	}
	function hapus_surat_lama($alur, $enc)
	{
		$id = $this->encrypt->decode(base64_decode($enc));
		$this->db->delete('ctr_surat_' . $alur, array('surat_id' => $id));
		redirect('Register/surat/' . $alur, 'refresh');
	}
	function config_file_lama($alur)
	{
		$config['upload_path'] 		= './upload/surat_' . $alur;
		$config['allowed_types'] 	= 'jpg|png|pdf|doc|docx|rar';
		$config['max_size']			= '80000';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
	}
}
