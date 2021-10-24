<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
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
	}

	public function index()
	{
		$this->load->view('header', array('title' => 'Stock', 'active' => 'list_stock'));
		$this->load->view('list_stock');
		$this->load->view('footer');
	}

	public function insert()
	{
		$d=date('YmdHis');
		$this->session->set_flashdata('msg', 'Stock berhasil ditambahkan.');
		$_POST['type'] = $_POST['jumlah'] > 0 ? "in" : "out";
		$_POST['invoice'] = $_POST['jumlah'] > 0 ? "IN$d" : "OUT$d";
		$this->dbhelper->save(TableStock, $_POST);
		redirect('stock');
	}

	public function showStock()
	{
		echo json_encode($this->dbhelper->select(TableStockName,'barang_id',1));
	}

	public function delete()
	{
		$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : -1;
		$result = $this->db->get_where(TableStock, array('id' => $id))->result();
		if (count($result) > 0) {
			$this->session->set_flashdata('msg', 'Stock berhasil dihapus.');
			$result = $this->dbhelper->delete(TableStock, 'id', $id);
			redirect('stock');
		} else {
			$this->session->set_flashdata('msg_error', 'Stock gagal dihapus');
			redirect('stock');
		}
	}

	public function ajaxlist()
	{
		header('Content-Type: application/json');
		$this->datatable->init(TableStockName, array("id", "nama", "create_at", "update_at"), array("nama", "create_at", "update_at", "id"), array("id", "asc"));
		$list = $this->datatable->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->invoice;
			$row[] = $field->nama;
			$row[] = $field->jumlah;
			$row[] = $field->type == "in" ? "Barang Masuk" : "Barang Keluar";
			$row[] = $field->keterangan;
			$row[] = $field->create_at;
			$row[] = $field->update_at;
			$row[] = '<a type="button" href="'.base_url("stock/delete/$field->id").'" class="btn btn-danger rounded-pill">Hapus</a>';
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
