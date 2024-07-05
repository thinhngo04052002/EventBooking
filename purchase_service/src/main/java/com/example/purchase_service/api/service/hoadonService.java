package com.example.purchase_service.api.service;

import java.math.BigDecimal;
import java.time.Duration;
import java.time.LocalDate;
import java.time.ZoneId;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.purchase_service.api.dto.HuyHoaDonDto;
import com.example.purchase_service.api.dto.addHoaDonDoiVeDto;
import com.example.purchase_service.api.dto.addHoaDonMuaVeDto;
import com.example.purchase_service.api.dto.addHoadonDto;
import com.example.purchase_service.api.dto.goiAPIThanhToanDto;
import com.example.purchase_service.api.dto.listVeCanMuaDto;
import com.example.purchase_service.api.dto.veDto;
import com.example.purchase_service.api.model.hoadon;
import com.example.purchase_service.api.model.khuyenmai;
import com.example.purchase_service.api.repository.hoadonRepository;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;

@Service
public class hoadonService {
    @Autowired
    private hoadonRepository repo;

    private final khuyenmaiService khuyenMaiService;

    public hoadonService(khuyenmaiService khuyenMaiService) {
        this.khuyenMaiService = khuyenMaiService;
    }

    public List<hoadon> getAllhoadon() {
        return repo.findAll();
    }

    public hoadon gethoadonById(int id) {
        return repo.findById(id);
    }

    public hoadon createhoadon(addHoadonDto dto) {
        // Tạo một đối tượng hoadon mới
        hoadon hoadon = new hoadon();
        hoadon.setIDTaiKhoan(dto.getIDTaiKhoan());
        hoadon.setIDVe(dto.getIDVe());
        hoadon.setIDSuKien(dto.getIDSuKien());
        hoadon.setIDDoiTac(dto.getIDDoiTac());
        hoadon.setIDKhuyenMai(dto.getIDKhuyenMai());
        hoadon.setThoiDiemThanhToan(dto.getThoiDiemThanhToan());
        hoadon.setHinhThucThanhToan(dto.getHinhThucThanhToan());
        hoadon.setThanhTien(dto.getThanhTien());
        hoadon.setDaHuy(dto.getDaHuy());

        // Lưu sản phẩm mới vào cơ sở dữ liệu
        return repo.save(hoadon);
    }

    public hoadon CreateHoaDonMuaVe(addHoaDonMuaVeDto dto) {
        // Kiểm tra tình trạng bán của vé từ service Product
        // Đây là hard code
        boolean TrangThaiBan = true;
        if (TrangThaiBan == false) {
            throw new RuntimeException("Vé đã được mua bởi người dùng khác.");
        } else {
            // Lấy giá trị chiết khấu từ khuyến mãi
            khuyenmai khuyenMai = khuyenMaiService.getKhuyenMaiByMakhuyenmai(dto.getMaKhuyenMai());
            if (khuyenMai == null) {
                throw new RuntimeException("Không tồn tại khuyến mãi.");
            }
            int chietkhau = khuyenMai.getChietkhau();
            // Lấy giá vé từ service Product
            BigDecimal giaVe = new BigDecimal("500000");
            // Tính thành tiền từ giá vé gốc và chiết khấu
            BigDecimal thanhTien = giaVe
                    .multiply(BigDecimal.ONE.subtract(new BigDecimal(chietkhau).divide(new BigDecimal(100))));
            // Tạo một đối tượng hoadon mới
            hoadon hoadon = new hoadon();
            hoadon.setIDTaiKhoan(dto.getIDTaiKhoan());
            hoadon.setIDVe(dto.getIDVe());
            hoadon.setIDSuKien(dto.getIDSuKien());
            hoadon.setIDDoiTac(dto.getIDDoiTac());
            hoadon.setIDKhuyenMai(khuyenMai.getId());
            hoadon.setThoiDiemThanhToan(dto.getThoiDiemThanhToan());
            hoadon.setHinhThucThanhToan(dto.getHinhThucThanhToan());
            hoadon.setThanhTien(thanhTien);
            hoadon.setDaHuy(0);

            // Lưu sản phẩm mới vào cơ sở dữ liệu
            return repo.save(hoadon);
        }
    }

    public hoadon CreateHoaDonDoiVe(addHoaDonDoiVeDto dto) {
        // Lấy IDTaiKhoan từ IDNguoiDung, service user
        int IDTaiKhoan = dto.getIDNguoiDung();
        // Lấy giá vé mà khách hàng thực sự trả khi mua từ service purchase, vé đã mua
        BigDecimal giaBan = new BigDecimal("350000");
        // Lấy giá niêm yết vé cũ và vé mới từ service purchase
        BigDecimal giaVeCu = new BigDecimal("400000");
        BigDecimal giaVeMoi = new BigDecimal("300000");
        // Lấy khoảng chênh lệch tiền vé = số tiền phải trả thêm, đổi vé trừ thêm 20%
        // giá niêm yết vé cũ
        BigDecimal ThanhTien = giaVeMoi.subtract(giaBan.subtract(giaVeCu.multiply(new BigDecimal("0.8"))));
        // Tạo một đối tượng hoadon mới
        hoadon hoadon = new hoadon();
        hoadon.setIDTaiKhoan(IDTaiKhoan);
        hoadon.setIDVe(dto.getIDVeMoi());
        hoadon.setIDSuKien(dto.getIDSuKien());
        hoadon.setIDDoiTac(dto.getIDDoiTac());
        hoadon.setThoiDiemThanhToan(dto.getThoiDiemThanhToan());
        hoadon.setHinhThucThanhToan(dto.getHinhThucThanhToan());
        hoadon.setThanhTien(ThanhTien);
        hoadon.setDaHuy(0);
        // Lưu sản phẩm mới vào cơ sở dữ liệu
        return repo.save(hoadon);
    }

    public hoadon updatehoadon(int id, addHoadonDto dto) {
        hoadon updatehoadon = repo.findById(id);
        if (updatehoadon != null) {
            updatehoadon.setIDTaiKhoan(dto.getIDTaiKhoan());
            updatehoadon.setIDVe(dto.getIDVe());
            updatehoadon.setIDKhuyenMai(dto.getIDKhuyenMai());
            updatehoadon.setThoiDiemThanhToan(dto.getThoiDiemThanhToan());
            updatehoadon.setHinhThucThanhToan(dto.getHinhThucThanhToan());
            updatehoadon.setThanhTien(dto.getThanhTien());
            updatehoadon.setDaHuy(dto.getDaHuy());
            return repo.save(updatehoadon);
        } else {
            return null;
        }
    }

    public hoadon HuyHoaDon(HuyHoaDonDto dto) {
        Date ThoiDiemThanhToan = new Date();
        // Kiểm tra người dùng đủ điều kiện đổi hoặc hủy vé không
        boolean check = checkRemainingTime(dto.getIDNguoiDung(), dto.getIDVe(), dto.getIDSuKien(), dto.getIDDoiTac(),
                ThoiDiemThanhToan);
        if (check == true) {
            // Lấy IDTaiKhoan từ IDNguoiDung, service user
            int IDTaiKhoan = dto.getIDNguoiDung();
            hoadon updatehoadon = repo.findByIDTaiKhoanAndIDVe(IDTaiKhoan, dto.getIDVe());
            if (updatehoadon != null) {
                updatehoadon.setDaHuy(1);
                return repo.save(updatehoadon);
            } else {
                return null;
            }
        } else {
            throw new RuntimeException("Không thõa điều kiện về thời điểm đổi vé.");
        }
    }

    public boolean deletehoadon(int id) {
        if (repo.existsById(id)) {
            repo.deleteById(id);
            return true;
        } else {
            return false;
        }
    }

    public boolean checkRemainingTime(int IDNguoiDung, int IDVe, int IDSuKien, int IDDoiTac, Date ThoiDiemDoiHuyVe) {
        // Lấy ra thời điểm bắt đầu của sự kiện từ VeDaMua của service Product
        // Hardcode demo thời điểm
        LocalDate ThoiDiemBatDau = LocalDate.of(2024, 6, 22);
        // Chuyển đổi Date sang LocalDate
        LocalDate ThoiDiemDoiHuyVeLocal = ThoiDiemDoiHuyVe.toInstant().atZone(ZoneId.systemDefault()).toLocalDate();
        // Tính khoảng thời gian chênh lệch giữa thời điểm hiện tại và thời điểm bắt đầu
        // sự kiện
        Duration duration = Duration.between(ThoiDiemDoiHuyVeLocal.atStartOfDay(), ThoiDiemBatDau.atStartOfDay());
        long ThoiGianChenhLech = duration.toDays();
        // Nếu còn hơn 7 ngày mới đến lúc bắt đầu sự kiện thì được phép đổi hoặc hủy vé
        if (ThoiGianChenhLech < 7) {
            return false;
        }
        return true;
    }

    public void CapNhatTrangThaiVe(List<veDto> listVe, String TrangThaiVe) {
        for (veDto ve : listVe) {
            // Gọi API putUpdateTinhTrangVe
        }
        return;
    }

    public List<veDto> CheckSoLuongVePhuHop(listVeCanMuaDto dto) {
        List<veDto> listVeXuLy = new ArrayList<veDto>();
        // Duyệt qua tất cả các loại vé
        for (Map.Entry<Integer, Integer> entry : dto.getLoaiVe_soLuong().entrySet()) {
            int IDLoaiVe = entry.getKey();
            int SoLuong = entry.getValue();
            // Với từng loại vé, check đủ số lượng vé không
            // for (int i=0;i<SoLuong;i++){
            // Gọi api getMotVeChuaBan
            // veDto ve = getMotVeChuaBan(IDLoaiVe,IdSuatDien,IdDoiTac,idSuKien);
            // if (ve.idloaive == 0)
            // CapNhatTrangThaiVe(listVeXuLy,"Chưa bán");
            // return null;
            // else{
            // Thêm vào
            // listVeXuLy.append(ve);
            // }
            // return listVeXuLy;
        }
        // return list ve xu ly;
        return listVeXuLy;
    }

    public boolean CheckVeCanMua(listVeCanMuaDto dto) {
        // Check login
        // If (IsLogin()==false) tbao và chuyển hướng màn đăng nhập;
        // Check db xem đủ vé thõa điều kiện khách cần không
        List<veDto> listve = CheckSoLuongVePhuHop(dto);
        if (listve == null) {
            // tbao và chuyển hướng màn chọn vé
        }
        return true;
    }

    // Hàm này sẽ được gọi khi Khách hàng bấm nút thanh toán
    public void GoiAPIThanhToan(goiAPIThanhToanDto dto) {
        // Lấy giá trị chiết khấu từ khuyến mãi
        khuyenmai khuyenMai = khuyenMaiService.getKhuyenMaiByMakhuyenmai(dto.getMakhuyenmai());
        if (khuyenMai == null) {
            throw new RuntimeException("Không tồn tại khuyến mãi.");
        }
        int chietkhau = khuyenMai.getChietkhau();
        // Thời điểm hết hạn thanh toán
        long expiresAtTimestamp = System.currentTimeMillis() / 1000 + 15 * 60; // Timestamp UNIX sau 15 phút
        // Chuyển đổi dto sang JSON
        ObjectMapper objectMapper = new ObjectMapper();
        try {
            String jsonString = objectMapper.writeValueAsString(dto);
            System.out.println(jsonString);
        } catch (JsonProcessingException e) {
            e.printStackTrace();
        }
        // //Code decode trong php:
        // //$expiresAt = (new DateTime())->setTimestamp($expiresAtTimestamp);
        // Nối chuỗi kiểu json
        // truyền message lên RabbitMQ
    }

    // Mong muốn sau khi thanh toán thành công, service thanh toán sẽ gửi ds vé đã
    // thanh toán về
    public void XuLyThanhToanThanhCong(List<veDto> listve) {
        // for item in listve
        // Gọi API Cập nhật trạng thái vé thành đã bán
        // Gọi API AddVeDaMua
    }

}
