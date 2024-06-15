package com.example.demo.controller;

import java.net.DatagramSocket;
import java.net.InetAddress;
import java.time.Duration;
import java.time.Instant;
import java.util.ArrayList;
import java.util.List;

import org.bson.types.ObjectId;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
// import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.dto.AddLoggingDoiVeHoanTienDto;
import com.example.demo.dto.AddLoggingDoiVeThanhToanThemDto;
import com.example.demo.dto.AddLoggingHuyVeDto;
import com.example.demo.dto.AddLoggingMuaVeDto;
import com.example.demo.model.Logging;
import com.example.demo.repository.LoggingRepository;

import jakarta.servlet.http.HttpServletRequest;

@RestController
@RequestMapping("/logging")
public class LoggingController {
    @Autowired
    private LoggingRepository repo;

    @GetMapping("/getAll")
    public ResponseEntity<List<Logging>> getAllLogging() {
        try {
            List<Logging> logginglist = new ArrayList<Logging>();
            repo.findAll().forEach(logginglist::add);
            if (logginglist.isEmpty()) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(logginglist, HttpStatus.OK);
        } catch (Exception e) {
            List<Logging> logginglist = new ArrayList<Logging>();
            return new ResponseEntity<>(logginglist, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    // @PostMapping("/add")
    // public ResponseEntity<Logging> AddLogging(@RequestBody Logging Logging,
    // HttpServletRequest request) {
    // try {
    // // Tạo _id
    // ObjectId objectId = new ObjectId();
    // String _id = objectId.toHexString();
    // // Lấy địa chỉ IP của thiết bị
    // String ipAddress = "";
    // try (final DatagramSocket socket = new DatagramSocket()) {
    // socket.connect(InetAddress.getByName("8.8.8.8"), 10002);
    // ipAddress = socket.getLocalAddress().getHostAddress();
    // }
    // Logging _Logging = repo.save(new Logging(_id, Logging.getTenHanhDong(),
    // Instant.now().plus(Duration.ofHours(7)), Logging.getMoTa(), ipAddress));
    // return new ResponseEntity<>(_Logging, HttpStatus.CREATED);
    // } catch (Exception e) {
    // return new ResponseEntity<>(Logging, HttpStatus.INTERNAL_SERVER_ERROR);
    // }
    // }

    @PostMapping("/addLoggingMuaVe")
    public ResponseEntity<Logging> AddLoggingMuaVe(@RequestBody AddLoggingMuaVeDto dto, HttpServletRequest request) {
        try {
            Logging _Logging = new Logging();
            // Tạo _id
            ObjectId objectId = new ObjectId();
            String _id = objectId.toHexString();
            // Tạo mô tả
            String moTa = "Khách hàng có id " + dto.getIdKhachHang() + " đã mua vé [";
            List<Integer> DanhSachVe = dto.getDanhSachVe();
            for (int i = 0; i < DanhSachVe.size() - 1; i++)
                moTa = moTa + DanhSachVe.get(i).toString() + ",";
            moTa = moTa + DanhSachVe.get(DanhSachVe.size() - 1) + "] với tổng tiền là " + dto.getTongTien();
            // Lấy địa chỉ IP của thiết bị
            String ipAddress = "";
            try (final DatagramSocket socket = new DatagramSocket()) {
                socket.connect(InetAddress.getByName("8.8.8.8"), 10002);
                ipAddress = socket.getLocalAddress().getHostAddress();
            }
            // Lưu dữ liệu vào database
            _Logging = repo.save(new Logging(_id, "Mua vé",
                    Instant.now().plus(Duration.ofHours(7)), moTa, ipAddress));
            return new ResponseEntity<>(_Logging, HttpStatus.CREATED);
        } catch (Exception e) {
            Logging _Logging = new Logging();
            return new ResponseEntity<>(_Logging, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @PostMapping("/addLoggingDoiVeThanhToanThem")
    public ResponseEntity<Logging> AddLoggingDoiVeThanhToanThem(@RequestBody AddLoggingDoiVeThanhToanThemDto dto,
            HttpServletRequest request) {
        try {
            Logging _Logging = new Logging();
            // Tạo _id
            ObjectId objectId = new ObjectId();
            String _id = objectId.toHexString();
            // Tạo mô tả
            String moTa = "Khách hàng có id " + dto.getIdKhachHang() + " đã đổi vé [" + dto.getIdVeCu() + "] sang vé ["
                    + dto.getIdVeMoi() + "] với tổng tiền thanh toán thêm là " + dto.getSoTienThanhToanThem();
            // Lấy địa chỉ IP của thiết bị
            String ipAddress = "";
            try (final DatagramSocket socket = new DatagramSocket()) {
                socket.connect(InetAddress.getByName("8.8.8.8"), 10002);
                ipAddress = socket.getLocalAddress().getHostAddress();
            }
            // Lưu dữ liệu vào database
            _Logging = repo.save(new Logging(_id, "Đổi vé thanh toán thêm",
                    Instant.now().plus(Duration.ofHours(7)), moTa, ipAddress));
            return new ResponseEntity<>(_Logging, HttpStatus.CREATED);
        } catch (Exception e) {
            Logging _Logging = new Logging();
            return new ResponseEntity<>(_Logging, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @PostMapping("/addLoggingDoiVeHoanTien")
    public ResponseEntity<Logging> AddLoggingDoiVeHoanTien(@RequestBody AddLoggingDoiVeHoanTienDto dto,
            HttpServletRequest request) {
        try {
            Logging _Logging = new Logging();
            // Tạo _id
            ObjectId objectId = new ObjectId();
            String _id = objectId.toHexString();
            // Tạo mô tả
            String moTa = "Khách hàng có id " + dto.getIdKhachHang() + " đã đổi vé [" + dto.getIdVeCu() + "] sang vé ["
                    + dto.getIdVeMoi() + "], tổng tiền hoàn lại là " + dto.getSoTienHoan();
            // Lấy địa chỉ IP của thiết bị
            String ipAddress = "";
            try (final DatagramSocket socket = new DatagramSocket()) {
                socket.connect(InetAddress.getByName("8.8.8.8"), 10002);
                ipAddress = socket.getLocalAddress().getHostAddress();
            }
            // Lưu dữ liệu vào database
            _Logging = repo.save(new Logging(_id, "Đổi vé thanh toán thêm",
                    Instant.now().plus(Duration.ofHours(7)), moTa, ipAddress));
            return new ResponseEntity<>(_Logging, HttpStatus.CREATED);
        } catch (Exception e) {
            Logging _Logging = new Logging();
            return new ResponseEntity<>(_Logging, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @PostMapping("/addLoggingHuyVe")
    public ResponseEntity<Logging> AddLoggingHuyVe(@RequestBody AddLoggingHuyVeDto dto,
            HttpServletRequest request) {
        try {
            Logging _Logging = new Logging();
            // Tạo _id
            ObjectId objectId = new ObjectId();
            String _id = objectId.toHexString();
            // Tạo mô tả
            String moTa = "Khách hàng có id " + dto.getIdKhachHang() + " đã hủy vé [" + dto.getIdVe()
                    + "], tổng tiền hoàn lại là " + dto.getSoTienHoan();
            // Lấy địa chỉ IP của thiết bị
            String ipAddress = "";
            try (final DatagramSocket socket = new DatagramSocket()) {
                socket.connect(InetAddress.getByName("8.8.8.8"), 10002);
                ipAddress = socket.getLocalAddress().getHostAddress();
            }
            // Lưu dữ liệu vào database
            _Logging = repo.save(new Logging(_id, "Đổi vé thanh toán thêm",
                    Instant.now().plus(Duration.ofHours(7)), moTa, ipAddress));
            return new ResponseEntity<>(_Logging, HttpStatus.CREATED);
        } catch (Exception e) {
            Logging _Logging = new Logging();
            return new ResponseEntity<>(_Logging, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

}
