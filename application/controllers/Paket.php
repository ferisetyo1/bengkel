<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
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
		$this->load->view('header', array('title' => 'Paket', 'active' => 'list_paket'));
		$this->load->view('list_paket');
		$this->load->view('footer');
	}

	public function insert()
	{
		$result = $this->db->get_where(TablePaket, array('nama' => $_POST['nama']))->result();
		if (count($result) == 0) {
			$this->session->set_flashdata('msg', 'Paket berhasil ditambahkan.');
			$result = $this->dbhelper->save(TablePaket, array('nama' => $_POST['nama']));
			redirect('paket');
		} else {
			$this->session->set_flashdata('msg_error', 'Paket sudah ada.');
			redirect('paket');
		}
	}

	public function edit()
	{
		$result = $this->db->get_where(TablePaket, array('nama' => $_POST['nama']))->result();
		if (count($result) == 0) {
			$this->session->set_flashdata('msg', 'Paket berhasil diupdate.');
			$result = $this->dbhelper->update(TablePaket, 'id', $_POST['id'], array('nama' => $_POST['nama']));
			redirect('paket');
		} else {
			$this->session->set_flashdata('msg_error', 'Paket sudah ada.');
			redirect('paket');
		}
	}

	public function delete()
	{
		$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : -1;
		$result = $this->db->get_where(TablePaket, array('id' => $id))->result();
		if (count($result) > 0) {
			$this->session->set_flashdata('msg', 'Rak berhasil dihapus.');
			$result = $this->dbhelper->delete(TablePaket, 'id', $id);
			redirect('paket');
		} else {
			$this->session->set_flashdata('msg_error', 'Rak gagal dihapus');
			redirect('paket');
		}
	}

	public function tambahbarang($id)
	{
		$result = $this->dbhelper->select(TablePaket, 'id', $id);
		$barang = $this->dbhelper->select(TableBarangPaketNama, 'id_paket', $id);
		if (($result[0])) {
			$this->load->view('header', array('title' => 'Tambah barang', 'active' => 'list_paket'));
			$this->load->view('tambah_barang_paket', array('data' => $result[0], 'barang' => $barang));
			$this->load->view('footer');
		} else {
			$this->session->set_flashdata('msg_error', 'Transaksi tidak ada');
			redirect('paket');
		}
	}

	public function simpanbarang()
	{
		$pos = 0;
		$this->dbhelper->delete(TableBarangPaket, 'id_paket', $_POST['id_paket']);
		foreach ($_POST['id'] as $key => $value) {
			$this->db->insert(TableBarangPaket, array(
				'id_paket' => $_POST['id_paket'],
				'id_barang' => $value,
				'jumlah' => $_POST['jumlah'][$pos],
				'harga' => $_POST['harga'][$pos]
			));
			$pos++;
		}
		$this->session->set_flashdata('msg', 'Berhasil menyimpan barang');
		redirect('paket');
	}

	public function keranjang($idpaket)
	{
		$barang = $this->dbhelper->select(TableBarangPaketNama, 'id_paket', $idpaket);
		echo json_encode($barang);
	}

	public function ajaxlist()
	{
		header('Content-Type: application/json');
		$this->datatable->init(TablePaket, array("id", "nama", "create_at", "update_at"), array("nama", "create_at", "update_at", "id"), array("id", "asc"));
		$list = $this->datatable->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama;
			$row[] = $field->create_at;
			$row[] = $field->update_at;
			$row[] = '<a type="button" class="btn btn-warning rounded-pill" href="' . base_url("paket/tambahbarang/$field->id") . '">Tambah Barang</a>'
				. '  <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#inlineForm-edit" data-json=' . "'" . json_encode($field) . "'" . '>Edit</button>'
				. '  <a type="button" class="btn btn-danger rounded-pill" href="' . base_url("paket/delete/$field->id") . '">Hapus</a>';
			// $row[]="";
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
	public function ajaxlist_keranjang()
	{
		header('Content-Type: application/json');
		$this->datatable->init(TablePaket, array("id", "nama", "create_at", "update_at"), array("nama", "create_at", "update_at", "id"), array("id", "asc"));
		$list = $this->datatable->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<button type="button" class="btn btn-danger rounded-pill" onclick="requesttambahkeranjang('.$field->id.')">+ Keranjang</button>';
			$row[] = $field->nama;
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
