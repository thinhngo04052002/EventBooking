package ProductApplication.DTO;

import java.util.List;

import org.springframework.boot.autoconfigure.SpringBootApplication;
//import ProductApplication.DTO.DiaDiemDTO;
@SpringBootApplication
public class AddSuKienDTO {
	private Integer IDDoiTac;
    private String AnhNenSuKien;
    private String TenSuKien;
    private String TheLoai;
    private String AnhSoDoGhe;
    private String ThongTinSuKien;
    private String DiaChi;
    private DiaDiemDTO DiaDiem;
    private String DuongDan;
    private String LoiCamOn;
    private List<SuatDienItemDTO> SuatDienItemDTO;

	public AddSuKienDTO() {
		super();
		// TODO Auto-generated constructor stub
	}

	

	public Integer getIDDoiTac() {
		return IDDoiTac;
	}

	public void setIDDoiTac(Integer iDDoiTac) {
		IDDoiTac = iDDoiTac;
	}

	public String getAnhNenSuKien() {
		return AnhNenSuKien;
	}

	public void setAnhNenSuKien(String anhNenSuKien) {
		AnhNenSuKien = anhNenSuKien;
	}

	public String getTenSuKien() {
		return TenSuKien;
	}

	public void setTenSuKien(String tenSuKien) {
		TenSuKien = tenSuKien;
	}

	public String getTheLoai() {
		return TheLoai;
	}

	public void setTheLoai(String theLoai) {
		TheLoai = theLoai;
	}

	public String getAnhSoDoGhe() {
		return AnhSoDoGhe;
	}

	public void setAnhSoDoGhe(String anhSoDoGhe) {
		AnhSoDoGhe = anhSoDoGhe;
	}

	
	public String getThongTinSuKien() {
		return ThongTinSuKien;
	}

	public void setThongTinSuKien(String thongTinSuKien) {
		ThongTinSuKien = thongTinSuKien;
	}

	public String getDiaChi() {
		return DiaChi;
	}

	public void setDiaChi(String diaChi) {
		DiaChi = diaChi;
	}

	public DiaDiemDTO getDiaDiem() {
		return DiaDiem;
	}

	public void setDiaDiem(DiaDiemDTO diaDiem) {
		DiaDiem = diaDiem;
	}

	public String getDuongDan() {
		return DuongDan;
	}

	public void setDuongDan(String duongDan) {
		DuongDan = duongDan;
	}

	public String getLoiCamOn() {
		return LoiCamOn;
	}

	public void setLoiCamOn(String loiCamOn) {
		LoiCamOn = loiCamOn;
	}

	public List<SuatDienItemDTO> getSuatDienItemDTO() {
		return SuatDienItemDTO;
	}

	public void setSuatDienItemDTO(List<SuatDienItemDTO> suatDienItemDTO) {
		SuatDienItemDTO = suatDienItemDTO;
	}



	public AddSuKienDTO(Integer iDDoiTac, String anhNenSuKien, String tenSuKien, String theLoai, String anhSoDoGhe,
			String thongTinSuKien, String diaChi, DiaDiemDTO diaDiem, String duongDan, String loiCamOn,
			List<ProductApplication.DTO.SuatDienItemDTO> suatDienItemDTO) {
		super();
		IDDoiTac = iDDoiTac;
		AnhNenSuKien = anhNenSuKien;
		TenSuKien = tenSuKien;
		TheLoai = theLoai;
		AnhSoDoGhe = anhSoDoGhe;
		ThongTinSuKien = thongTinSuKien;
		DiaChi = diaChi;
		DiaDiem = diaDiem;
		DuongDan = duongDan;
		LoiCamOn = loiCamOn;
		SuatDienItemDTO = suatDienItemDTO;
	}



	@Override
	public String toString() {
		return "AddSuKienDTO [IDDoiTac=" + IDDoiTac + ", AnhNenSuKien=" + AnhNenSuKien + ", TenSuKien=" + TenSuKien
				+ ", TheLoai=" + TheLoai + ", AnhSoDoGhe=" + AnhSoDoGhe + ", ThongTinSuKien=" + ThongTinSuKien
				+ ", DiaChi=" + DiaChi + ", DiaDiem=" + DiaDiem + ", DuongDan=" + DuongDan + ", LoiCamOn=" + LoiCamOn
				+ ", SuatDienItemDTO=" + SuatDienItemDTO + "]";
	}

	
}
