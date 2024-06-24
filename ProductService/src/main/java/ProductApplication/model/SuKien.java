package ProductApplication.model;


import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.core.mapping.Field;

@SpringBootApplication
@Document(collection = "SuKien")
public class SuKien {
	
	@Id
    private String _id;
	@Field("IDSuKien")
    private Integer idSuKien;
	@Field("IDDoiTac")
    private Integer idDoiTac;
	@Field("ThanhToan")
    private String thanhToan;
	@Field("AnhNenSuKien")
    private String anhNenSuKien;
	@Field("TenSuKien")
    private String tenSuKien;
	@Field("TheLoai")
    private String theLoai;
	@Field("AnhSoDoGhe")
    private String anhSoDoGhe;
	@Field("ThongTinSuKien")
    private String thongTinSuKien;
	@Field("DiaChi")
    private String diaChi;
	@Field("DiaDiem")
    private DiaDiem diaDiem;
	@Field("DuongDan")
    private String duongDan;
	@Field("LoiCamOn")
    private String loiCamOn;
    
    public SuKien() {
        super();
    }

	public SuKien(String _id, Integer idSuKien, Integer idDoiTac, String thanhToan, String anhNenSuKien,
			String tenSuKien, String theLoai, String anhSoDoGhe, String thongTinSuKien, String diaChi, DiaDiem diaDiem,
			String duongDan, String loiCamOn) {
		super();
		this._id = _id;
		this.idSuKien = idSuKien;
		this.idDoiTac = idDoiTac;
		this.thanhToan = thanhToan;
		this.anhNenSuKien = anhNenSuKien;
		this.tenSuKien = tenSuKien;
		this.theLoai = theLoai;
		this.anhSoDoGhe = anhSoDoGhe;
		this.thongTinSuKien = thongTinSuKien;
		this.diaChi = diaChi;
		this.diaDiem = diaDiem;
		this.duongDan = duongDan;
		this.loiCamOn = loiCamOn;
	}

	@Override
	public String toString() {
		return "SuKien [_id=" + _id + ", idSuKien=" + idSuKien + ", idDoiTac=" + idDoiTac + ", thanhToan=" + thanhToan
				+ ", anhNenSuKien=" + anhNenSuKien + ", tenSuKien=" + tenSuKien + ", theLoai=" + theLoai
				+ ", anhSoDoGhe=" + anhSoDoGhe + ", thongTinSuKien=" + thongTinSuKien + ", diaChi=" + diaChi
				+ ", diaDiem=" + diaDiem + ", duongDan=" + duongDan + ", loiCamOn=" + loiCamOn + "]";
	}

	public String get_id() {
		return _id;
	}

	public void set_id(String _id) {
		this._id = _id;
	}

	public Integer getIdSuKien() {
		return idSuKien;
	}

	public void setIdSuKien(Integer idSuKien) {
		this.idSuKien = idSuKien;
	}

	public Integer getIdDoiTac() {
		return idDoiTac;
	}

	public void setIdDoiTac(Integer idDoiTac) {
		this.idDoiTac = idDoiTac;
	}

	public String getThanhToan() {
		return thanhToan;
	}

	public void setThanhToan(String thanhToan) {
		this.thanhToan = thanhToan;
	}

	public String getAnhNenSuKien() {
		return anhNenSuKien;
	}

	public void setAnhNenSuKien(String anhNenSuKien) {
		this.anhNenSuKien = anhNenSuKien;
	}

	public String getTenSuKien() {
		return tenSuKien;
	}

	public void setTenSuKien(String tenSuKien) {
		this.tenSuKien = tenSuKien;
	}

	public String getTheLoai() {
		return theLoai;
	}

	public void setTheLoai(String theLoai) {
		this.theLoai = theLoai;
	}

	public String getAnhSoDoGhe() {
		return anhSoDoGhe;
	}

	public void setAnhSoDoGhe(String anhSoDoGhe) {
		this.anhSoDoGhe = anhSoDoGhe;
	}

	public String getThongTinSuKien() {
		return thongTinSuKien;
	}

	public void setThongTinSuKien(String thongTinSuKien) {
		this.thongTinSuKien = thongTinSuKien;
	}

	public String getDiaChi() {
		return diaChi;
	}

	public void setDiaChi(String diaChi) {
		this.diaChi = diaChi;
	}

	public DiaDiem getDiaDiem() {
		return diaDiem;
	}

	public void setDiaDiem(DiaDiem diaDiem) {
		this.diaDiem = diaDiem;
	}

	public String getDuongDan() {
		return duongDan;
	}

	public void setDuongDan(String duongDan) {
		this.duongDan = duongDan;
	}

	public String getLoiCamOn() {
		return loiCamOn;
	}

	public void setLoiCamOn(String loiCamOn) {
		this.loiCamOn = loiCamOn;
	}

}
