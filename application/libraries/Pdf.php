<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf {

	protected $pdf;

	public function __construct()
	{
		$this->pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
		$this->pdf->SetMargins(15, 15, 15);
		$this->pdf->SetHeaderMargin(0);
		$this->pdf->SetFooterMargin(10);
		$this->pdf->setPrintHeader(false);
		$this->pdf->setPrintFooter(false);
		$this->pdf->SetAutoPageBreak(true, 15);
		$this->pdf->SetFont('helvetica', '', 10);
	}

	public function generate($html, $filename = 'document')
	{
		$this->pdf->AddPage();
		$this->pdf->writeHTML($html, true, false, true, false, '');
		$this->pdf->Output($filename . '.pdf', 'I');
	}
}
