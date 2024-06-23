package ProductApplication.model;

import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.core.mapping.Field;

@Document(collection = "VeDaMua")
public class NhanSu {
    
	
	@Field("VaiTro")
	private String vaiTro;
	@Field("email")
	private String email;
	@Field("SoDienThoai")
	private String soDienThoai;
	@Field("Ten")
	private String ten;
	
	public NhanSu() {
		super();
		// TODO Auto-generated constructor stub
	}

	public NhanSu(String vaiTro, String email, String soDienThoai, String ten) {
		super();
		this.vaiTro = vaiTro;
		this.email = email;
		this.soDienThoai = soDienThoai;
		this.ten = ten;
	}

	@Override
	public String toString() {
		return "NhanSu [vaiTro=" + vaiTro + ", email=" + email + ", soDienThoai=" + soDienThoai + ", ten=" + ten + "]";
	}

	public String getVaiTro() {
		return vaiTro;
	}

	public void setVaiTro(String vaiTro) {
		this.vaiTro = vaiTro;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getSoDienThoai() {
		return soDienThoai;
	}

	public void setSoDienThoai(String soDienThoai) {
		this.soDienThoai = soDienThoai;
	}

	public String getTen() {
		return ten;
	}

	public void setTen(String ten) {
		this.ten = ten;
	}
	
	
}
