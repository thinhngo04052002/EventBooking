package ProductApplication.DTO;

import java.util.List;

public class SuatDienItemDTO {
    

	private Integer soThuTu;
	private String thoiGianBatDau;
	private String thoiGianKetThuc;
	private List<AgendaDTO> agenda;
	private List<LoaiVeDTO> loaiVe;
	private List<String> nguoiThamGia;
	private List<NhanSuDTO> nhanSu;
	
	@Override
	public String toString() {
		return "SuatDienItemDTO [soThuTu=" + soThuTu + ", thoiGianBatDau=" + thoiGianBatDau + ", thoiGianKetThuc="
				+ thoiGianKetThuc + ", agenda=" + agenda + ", loaiVe=" + loaiVe + ", nguoiThamGia=" + nguoiThamGia
				+ ", nhanSu=" + nhanSu + "]";
	}

	public Integer getSoThuTu() {
		return soThuTu;
	}

	public void setSoThuTu(Integer soThuTu) {
		this.soThuTu = soThuTu;
	}

	public String getThoiGianBatDau() {
		return thoiGianBatDau;
	}

	public void setThoiGianBatDau(String thoiGianBatDau) {
		this.thoiGianBatDau = thoiGianBatDau;
	}

	public String getThoiGianKetThuc() {
		return thoiGianKetThuc;
	}

	public void setThoiGianKetThuc(String thoiGianKetThuc) {
		this.thoiGianKetThuc = thoiGianKetThuc;
	}

	public List<AgendaDTO> getAgenda() {
		return agenda;
	}

	public void setAgenda(List<AgendaDTO> agenda) {
		this.agenda = agenda;
	}

	public List<LoaiVeDTO> getLoaiVe() {
		return loaiVe;
	}

	public void setLoaiVe(List<LoaiVeDTO> loaiVe) {
		this.loaiVe = loaiVe;
	}

	public List<String> getNguoiThamGia() {
		return nguoiThamGia;
	}

	public void setNguoiThamGia(List<String> nguoiThamGia) {
		this.nguoiThamGia = nguoiThamGia;
	}

	public List<NhanSuDTO> getNhanSu() {
		return nhanSu;
	}

	public void setNhanSu(List<NhanSuDTO> nhanSu) {
		this.nhanSu = nhanSu;
	}

	public SuatDienItemDTO() {
		super();
		// TODO Auto-generated constructor stub
	}

	public SuatDienItemDTO(Integer soThuTu, String thoiGianBatDau, String thoiGianKetThuc, List<AgendaDTO> agenda,
			List<LoaiVeDTO> loaiVe, List<String> nguoiThamGia, List<NhanSuDTO> nhanSu) {
		super();
		this.soThuTu = soThuTu;
		this.thoiGianBatDau = thoiGianBatDau;
		this.thoiGianKetThuc = thoiGianKetThuc;
		this.agenda = agenda;
		this.loaiVe = loaiVe;
		this.nguoiThamGia = nguoiThamGia;
		this.nhanSu = nhanSu;
	}
    
	
	
}
