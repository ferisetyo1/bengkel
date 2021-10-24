<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
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
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$per_page = 20;
		if (isset($_GET["nama"])) {
			$total_row = count($this->db->like('nama', $_GET['nama'])->get(TableJenis)->result());
		} else {
			$total_row = $this->db->count_all(TableJenis);
		}
		$total_page = floor($total_row / $per_page);
		$pagination = '<div class="pagging"><nav><ul class="pagination float-sm-end">';

		if ($total_page > 1) {
			if ($page > 1) {
				$prev = $page - 1;
				$pagination .= '<li class="page-item"><span class="page-link"><a href="http://localhost/bengkel/jenis/index/' . $prev . '" data-ci-pagination-page="' . $prev . '" rel="prev">Prev</a></span></li>';
			}

			for ($i = $page - 2; $i <= $page; $i++) {
				if ($i > 0) {
					if ($i == $page) {
						$pagination .= '<li class="page-item active"><span class="page-link">' . $i . '<span class="sr-only"></span></span></li>';
					} else $pagination .= '<li class="page-item"><span class="page-link"><a href="http://localhost/bengkel/jenis/index/' . $i . '" data-ci-pagination-page="' . $i . '" rel="prev">' . $i . '</a></span></li>';
				}
			}
			for ($i = $page + 1; $i < $page + 2; $i++) {
				if ($i < $total_page - 1) {
					$pagination .= '<li class="page-item"><span class="page-link"><a href="http://localhost/bengkel/jenis/index/' . $i . '" data-ci-pagination-page="' . $i . '" rel="prev">' . $i . '</a></span></li>';
				}
			}
			// if (($total_page - 3) > $page) {
			if (($total_page - 3) > $page) $pagination .= '<li class="page-item"><span class="page-link">...<span class="sr-only"></span></span></li>';
			for ($i = $total_page - 1; $i <= $total_page; $i++) {
				if ($i > 0 && $i != $page) {
					$pagination .= '<li class="page-item"><span class="page-link"><a href="http://localhost/bengkel/jenis/index/' . $i . '" data-ci-pagination-page="' . $i . '" rel="prev">' . $i . '</a></span></li>';
				}
				// }
			}

			if ($page != $total_page && $total_page > 1) {
				$next = $page + 1;
				$pagination .= '<li class="page-item"><span class="page-link"><a href="http://localhost/bengkel/jenis/index/' . $next . '" data-ci-pagination-page="58" rel="prev">Next</a></span></li>';
			}
		}

		$pagination .= '</ul></nav></div>';

		if (isset($_GET["nama"])) {
			$data['data'] = $this->db->like('nama', $_GET['nama'])->get(TableJenis, $per_page, ($page - 1) * $per_page)->result();
		} else {
			$data['data'] = $this->db->get(TableJenis, $per_page, ($page - 1) * $per_page)->result();
		}

		$data['pagination'] = $pagination;
		$this->load->view('header', array('title' => 'Jenis Barang', 'active' => 'list_jenis'));
		$this->load->view('list_jenis', $data);
		$this->load->view('footer');
	}

	public function insert()
	{
		$result = $this->db->get_where(TableJenis, array('nama' => $_POST['nama']))->result();
		if (count($result) == 0) {
			$this->session->set_flashdata('msg', 'Jenis berhasil ditambahkan.');
			$result = $this->dbhelper->save(TableJenis, array('nama' => $_POST['nama']));
			redirect('jenis');
		} else {
			$this->session->set_flashdata('msg_error', 'Jenis sudah ada.');
			redirect('jenis');
		}
	}

	public function edit()
	{
		$result = $this->db->get_where(TableJenis, array('nama' => $_POST['nama']))->result();
		if (count($result) == 0) {
			$this->session->set_flashdata('msg', 'Jenis berhasil diupdate.');
			$result = $this->dbhelper->update(TableJenis, 'id', $_POST['id'], array('nama' => $_POST['nama']));
			redirect('jenis');
		} else {
			$this->session->set_flashdata('msg_error', 'Jenis sudah ada.');
			redirect('jenis');
		}
	}

	public function delete()
	{
		$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : -1;
		$result = $this->db->get_where(TableJenis, array('id' => $id))->result();
		if (count($result) > 0) {
			$this->session->set_flashdata('msg', 'Jenis berhasil dihapus.');
			$result = $this->dbhelper->delete(TableJenis, 'id', $id);
			redirect('jenis');
		} else {
			$this->session->set_flashdata('msg_error', 'Jenis gagal dihapus');
			redirect('jenis');
		}
	}
	
	public function ajaxlist()
	{
		header('Content-Type: application/json');
		$this->datatable->init(TableJenis, array("id", "nama", "create_at", "update_at"), array("nama", "create_at", "update_at", "id"), array("id", "asc"));
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
			$row[] = '<button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#inlineForm-edit" data-json=' . "." . json_encode($field) . "'" . '>Edit</button>'
				. '  <a type="button" class="btn btn-danger rounded-pill" href="' . base_url("jenis/delete/$field->id") . '">Hapus</a>';
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
