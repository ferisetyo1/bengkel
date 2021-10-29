<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('header', array('title' => 'List Transaksi', 'active' => 'transaksi'));
		$this->load->view('transaksi');
		$this->load->view('footer');
	}

	public function insert()
	{
		try {
			$redirect = ($_POST["redirect"]) ? $_POST["redirect"] : "transaksi";
			unset($_POST["redirect"]);
			$d = date('YmdHis');
			$_POST["no_trx"] = "TRX$d";
			$date = date_create($_POST["tgl_reservasi"]);
			$_POST["tgl_reservasi"] = date(date_format($date, "Y-m-d H:i:s"));
			$this->session->set_flashdata('msg', 'Transaksi berhasil ditambahkan.');
			$result = $this->dbhelper->save(TableTransaksi, $_POST);
			redirect($redirect);
		} catch (Exception $e) {
			$this->session->set_flashdata('msg_error', $e->getMessage());
			redirect($redirect);
		}
	}
	public function edit()
	{
		$result = $this->db->get_where(TablePelanggan, array('nohp' => $_POST['nohp']))->result();
		$id = -1;
		foreach ($result as $key => $value) {
			$id = $value->id;
		}
		if (count($result) == 0 || (count($result) == 1 && $id == $_POST['id'])) {
			$this->session->set_flashdata('msg', 'Pelanggan berhasil diupdate.');
			$result = $this->dbhelper->update(TablePelanggan, 'id', $_POST['id'], $_POST);
			redirect('pelanggan');
		} else {
			$this->session->set_flashdata('msg_error', 'Pelanggan gagal diupdate.');
			redirect('pelanggan');
		}
	}

	public function delete()
	{
		$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : -1;
		$result = $this->db->get_where(TableTransaksi, array('id' => $id))->result();
		if (count($result) > 0) {
			$this->session->set_flashdata('msg', 'Transaksi berhasil dihapus.');
			$result = $this->dbhelper->delete(TableTransaksi, 'id', $id);
			redirect('transaksi');
		} else {
			$this->session->set_flashdata('msg_error', 'Transaksi gagal dihapus');
			redirect('transaksi');
		}
	}

	public function tambahbarang($id)
	{
		$result = $this->dbhelper->select(TableTransaksi,'id',$id);
		$barang=$this->dbhelper->select(TableBarangTransaksiJumlah,'id_transaksi',$id);
		if(($result[0])){
			$this->load->view('header', array('title' => 'Tambah barang', 'active' => 'transaksi'));
			$this->load->view('tambah_barang',array('data'=>$result[0],'barang'=>$barang));
			$this->load->view('footer');
		}else{
			$this->session->set_flashdata('msg_error', 'Transaksi tidak ada');
			redirect('transaksi');
		}
	}

	public function simpanbarang()
	{
		$pos=0;
		$this->dbhelper->delete(TableBarangTransaksi, 'id_transaksi', $_POST['id_transaksi']);
		foreach ($_POST['id'] as $key => $value) {
			$d=date('YmdHis');
			$this->db->insert(TableStock,array(
				'barang_id'=>$value,
				'invoice'=>"OUT$d",
				'type'=>"out",
				'jumlah'=>$_POST['jumlah'][$pos]*-1,
				'keterangan'=>""
			));
			$this->db->insert(TableBarangTransaksi,array(
				'id_transaksi'=>$_POST['id_transaksi'],
				'id_barang'=>$value,
				'id_stock'=>$this->db->insert_id(),
				// 'jumlah'=>$_POST['jumlah'][$pos],
				'harga_jual'=>$_POST['harga'][$pos],
				'keterangan'=>$_POST['keterangan'][$pos],
			));
			$pos++;
		}
		$this->session->set_flashdata('msg', 'Berhasil menyimpan barang');
		redirect('transaksi');
	}

	public function ajaxlist()
	{
		header('Content-Type: application/json');
		$this->datatable->init(TableTransaksi, array("id", "nama", "create_at", "update_at"), array("nama", "create_at", "update_at", "id"), array("id", "asc"));
		$list = $this->datatable->get_datatables();
		$data = array();
		$no = $this->input->post('start');

		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->no_trx;
			$kendaraan = $this->db->get_where(TablePemilikKendaraan, array('id' => $field->id_kendaraan))->row();
			$row[] = ($kendaraan) ? $kendaraan->nama : "-";
			$row[] = ($kendaraan) ? $kendaraan->nopol : "-";
			$row[] = $field->tgl_reservasi;
			$row[] = $field->created_at;
			$row[] = $field->update_at;
			$row[] = '<a type="button" class="btn btn-warning rounded-pill" href="' . base_url("transaksi/tambahbarang/$field->id") . '">Tambah Barang</a>'
				. '  <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#inlineForm-edit" data-json=' . "." . json_encode($field) . "'" . '>Edit</button>'
				. '  <a type="button" class="btn btn-danger rounded-pill" href="' . base_url("transaksi/delete/$field->id") . '">Hapus</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $this->input->post('draw'),
			"recordsTotal" => $this->datatable->count_all(),
			"recordsFiltered" => $this->datatable->count_filtered(),
			"data" => $data,
		);
		//output to json format
		$this->output->set_output(json_encode($output));
	}
}
