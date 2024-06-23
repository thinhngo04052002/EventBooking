package ProductApplication.DTO;





public class NhanSuDTO {
    
	private String vaiTro;
	private String email;
	private String soDienThoai;
	private String ten;
	
	@Override
	public String toString() {
		return "NhanSuDTO [vaiTro=" + vaiTro + ", email=" + email + ", soDienThoai=" + soDienThoai + ", ten=" + ten
				+ "]";
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
