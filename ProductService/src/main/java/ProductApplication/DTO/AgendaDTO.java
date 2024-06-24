package ProductApplication.DTO;





public class AgendaDTO {

	private String thoiGian;
	private String hoatDong;
	
	@Override
	public String toString() {
		return "AgendaDTO [thoiGian=" + thoiGian + ", hoatDong=" + hoatDong + "]";
	}

	public String getThoiGian() {
		return thoiGian;
	}

	public void setThoiGian(String thoiGian) {
		this.thoiGian = thoiGian;
	}

	public String getHoatDong() {
		return hoatDong;
	}

	public void setHoatDong(String hoatDong) {
		this.hoatDong = hoatDong;
	}
    
	
}
