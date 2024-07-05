package ProductApplication.DTO;


import org.springframework.boot.autoconfigure.SpringBootApplication;
//import ProductApplication.DTO.DiaDiemDTO;
@SpringBootApplication
public class PostSuKienDTO {
//    private Integer IDSuKien;
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
    
	public PostSuKienDTO() {
		super();
		// TODO Auto-generated constructor stub
	}


	@Override
	public String toString() {
		return "PostSuKienDTO [IDDoiTac=" + IDDoiTac + ", AnhNenSuKien=" + AnhNenSuKien + ", TenSuKien=" + TenSuKien
				+ ", TheLoai=" + TheLoai + ", AnhSoDoGhe=" + AnhSoDoGhe + ", ThongTinSuKien=" + ThongTinSuKien
				+ ", DiaChi=" + DiaChi + ", DiaDiem=" + DiaDiem + ", DuongDan=" + DuongDan + ", LoiCamOn=" + LoiCamOn
				+ "]";
	}


	public PostSuKienDTO(Integer iDDoiTac, String anhNenSuKien, String tenSuKien, String theLoai, String anhSoDoGhe,
			String thongTinSuKien, String diaChi, DiaDiemDTO diaDiem, String duongDan, String loiCamOn) {
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
