package ProductApplication.DTO;

import org.springframework.boot.autoconfigure.SpringBootApplication;
//import ProductApplication.DTO.DiaDiemDTO;
@SpringBootApplication
public class SuKienDTO {
    private Integer IDSuKien;
    private Integer IDDoiTac;
    private String AnhNenSuKien;
    private String TenSuKien;
    private String TheLoai;
    private String AnhSoDoGhe;
    private String ThanhToan;
    private String ThongTinSuKien;
    private String DiaChi;
    private DiaDiemDTO DiaDiem;
    private String DuongDan;
    private String LoiCamOn;

	public SuKienDTO() {
		super();
		// TODO Auto-generated constructor stub
	}

	@Override
	public String toString() {
		return "SuKienDTO [IDSuKien=" + IDSuKien + ", IDDoiTac=" + IDDoiTac + ", AnhNenSuKien=" + AnhNenSuKien
				+ ", TenSuKien=" + TenSuKien + ", TheLoai=" + TheLoai + ", AnhSoDoGhe=" + AnhSoDoGhe + ", ThanhToan="
				+ ThanhToan + ", ThongTinSuKien=" + ThongTinSuKien + ", DiaChi=" + DiaChi + ", DiaDiem=" + DiaDiem
				+ ", DuongDan=" + DuongDan + ", LoiCamOn=" + LoiCamOn + "]";
	}

	public SuKienDTO(Integer iDSuKien, Integer iDDoiTac, String anhNenSuKien, String tenSuKien, String theLoai,
			String anhSoDoGhe, String thanhToan, String thongTinSuKien, String diaChi, DiaDiemDTO diaDiem,
			String duongDan, String loiCamOn) {
		super();
		IDSuKien = iDSuKien;
		IDDoiTac = iDDoiTac;
		AnhNenSuKien = anhNenSuKien;
		TenSuKien = tenSuKien;
		TheLoai = theLoai;
		AnhSoDoGhe = anhSoDoGhe;
		ThanhToan = thanhToan;
		ThongTinSuKien = thongTinSuKien;
		DiaChi = diaChi;
		DiaDiem = diaDiem;
		DuongDan = duongDan;
		LoiCamOn = loiCamOn;
	}

	public String getThanhToan() {
		return ThanhToan;
	}


	public void setThanhToan(String thanhToan) {
		ThanhToan = thanhToan;
	}

	public Integer getIDSuKien() {
		return IDSuKien;
	}

	public void setIDSuKien(Integer iDSuKien) {
		IDSuKien = iDSuKien;
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


}
