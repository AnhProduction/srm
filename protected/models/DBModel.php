<?php
/**
* Anh Production
*/
class DBModel extends CFormModel
{
	public function dashboard()
	{
		$result = array();
		$result['user']['all'] = count(Yii::app()->db->createCommand()
				->select("ID")
				->from('Account')
				->queryAll());
		$result['user']['active'] = count(Yii::app()->db->createCommand()
				->select("ID")
				->from('Account')
				->where('isActive = 1')
				->queryAll());
		$result['student'] = count(Yii::app()->db->createCommand()
				->select("SVID")
				->from('srm_hssv')
				->queryAll());
		$result['ngoaitru'] = count(Yii::app()->db->createCommand()
				->select("*")
				->from('srm_ngoaitru')
				->queryAll());
		$result['noitru'] = count(Yii::app()->db->createCommand()
				->select("*")
				->from('srm_noitru')
				->queryAll());
		$raw = Yii::app()->db->createCommand()
				->select("MaNganh, TenNganh")
				->from('srm_nganh')
				->queryAll();
				
		$MN = array();
		foreach ($raw as $key => $value) {
			$MN[$value['MaNganh']]['NUM'] = count(Yii::app()->db->createCommand()
				->select("SVID, MaNganh")
				->from('srm_hssv')
				->where('MaNganh=:MaNganh', array(':MaNganh'=>$value['MaNganh']))
				->queryAll());
			$MN[$value['MaNganh']]['NAME'] = $value['TenNganh'];
		}

		$result['dataNganh'] = $MN;
		$result['dataLop'] = count(Yii::app()->db->createCommand()
				->select("*")
				->from('srm_lop')
				->queryAll());
		return $result;
	}
	
	public function student()
	{
		$result = Yii::app()->db->createCommand()
				->select("*, srm_hssv.SVID as SID, srm_xa.name as TenXa, srm_huyen.name as TenHuyen, srm_tinh.name as TenTinh")
				->from('srm_hssv')
				->leftJoin('srm_noitru','srm_noitru.SVID = srm_hssv.SVID')
				->leftJoin('srm_ngoaitru','srm_ngoaitru.SVID = srm_hssv.SVID')
				->join('srm_nienkhoa','srm_nienkhoa.NienKhoa = srm_hssv.NienKhoa')
				->join('srm_lop','srm_lop.MaLop = srm_hssv.MaLop')
				->join('srm_nganh','srm_nganh.MaNganh = srm_hssv.MaNganh')
				->join('srm_xa','srm_hssv.HKTT = srm_xa.wardid')
				->join('srm_huyen','srm_huyen.districtid = srm_xa.districtid')
				->join('srm_tinh','srm_huyen.provinceid = srm_tinh.provinceid')
				->order('Ten')
				->queryAll();
		return $result;
	}

	public function Search($Keyword = "", $Lop = array(), $Nganh = array())
	{
		$queryLop = "";
		foreach ($Lop as $key => $value) {
			if(!$key) $queryLop .= " srm_hssv.MaLop = '{$value}' ";
			else  $queryLop .= " OR srm_hssv.MaLop = '{$value}' ";
		}
		$queryNganh = "";
		foreach ($Nganh as $key => $value) {
			if(!$key) $queryNganh .= " srm_hssv.MaNganh = '{$value}' ";
			else  $queryNganh .= " OR srm_hssv.MaNganh = '{$value}' ";
		}
		$result = Yii::app()->db->createCommand()
				->select("*, srm_hssv.SVID as SID, srm_xa.name as TenXa, srm_huyen.name as TenHuyen, srm_tinh.name as TenTinh")
				->from('srm_hssv')
				->leftJoin('srm_noitru','srm_noitru.SVID = srm_hssv.SVID')
				->leftJoin('srm_ngoaitru','srm_ngoaitru.SVID = srm_hssv.SVID')
				->join('srm_nienkhoa','srm_nienkhoa.NienKhoa = srm_hssv.NienKhoa')
				->join('srm_lop','srm_lop.MaLop = srm_hssv.MaLop')
				->join('srm_nganh','srm_nganh.MaNganh = srm_hssv.MaNganh')
				->join('srm_xa','srm_hssv.HKTT = srm_xa.wardid')
				->join('srm_huyen','srm_huyen.districtid = srm_xa.districtid')
				->join('srm_tinh','srm_huyen.provinceid = srm_tinh.provinceid')
				->where("(MaSV LIKE '%{$Keyword}%' OR CONCAT(HoDem,' ', Ten) LIKE '%{$Keyword}%') ".(!empty($queryLop)?(" AND (".$queryLop.")"):"").(!empty($queryNganh)?(" AND (".$queryNganh.")"):""))
				->order('Ten')
				->queryAll();
		return $result;
	}

	public function ThongKe()
	{
		# code...
	}
}