package ProductApplication.service;

import java.util.ArrayList;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import ProductApplication.DTO.DanhSachVeDaMuaDTO;
import ProductApplication.DTO.DiaDiemDTO;
import ProductApplication.DTO.ThoiGianDTO;
import ProductApplication.DTO.VeDaMuaDTO;
import ProductApplication.model.SuKien;
import ProductApplication.model.SuatDien;
import ProductApplication.model.SuatDienItem;
import ProductApplication.model.VeDaMua;
import ProductApplication.model.DanhSachVeDaMua;
import ProductApplication.model.DiaDiem;
import ProductApplication.model.LoaiVe;
import ProductApplication.model.ThoiGian;
import ProductApplication.model.Ve;
import ProductApplication.repository.SuKienRepository;
import ProductApplication.repository.SuatDienRepository;
import ProductApplication.repository.VeDaMuaRepository;
import ProductApplication.repository.VeRepository;


@Service
public class VeDaMuaService {

    @Autowired
    private VeDaMuaRepository veDaMuaRepository;
    @Autowired
    private VeRepository veRepository;
    @Autowired
    private SuKienRepository suKienRepository;
    @Autowired
    private SuatDienRepository suatDienRepository;
//    public List<VeDaMuaDTO> getAllVeDaMua() {
//        List<VeDaMua> veDaMuaList = veDaMuaRepository.findAll();
//        return veDaMuaList.stream()
//                          .map(this::convertToDTO)
//                          .collect(Collectors.toList());
//    }
    
    public VeDaMuaDTO getAllVeDaMuaByIdNguoiDung(Integer IDNguoiDung) {
        VeDaMua veDaMua = veDaMuaRepository.findByIDNguoiDung(IDNguoiDung);
        if (veDaMua!=null) {
            return convertToDTO(veDaMua);
        }else {
            return null; 
        }
    }

    public Integer createVeDaMua(Integer idNguoiDung,Integer idVe,Integer idSuKien,Integer idDoiTac) {
        
        Ve ve=veRepository.findByIDVeAndIDSuKienAndIDDoiTac(idVe,idSuKien,idDoiTac);
        if(ve==null) {
        	return 2; //khong tim thay ve
        }
        System.out.println("laythong tin ve"+ve);
        VeDaMua vdm=veDaMuaRepository.findByIDNguoiDung(idNguoiDung);
        if(vdm==null) {
        	vdm = new VeDaMua();
        	vdm.setIDNguoiDung(idNguoiDung);
        	vdm.setDanhSachVeDaMua(new ArrayList<>());
        }
        System.out.println("lay thong tin vedamua co id roi"+vdm);
        SuatDien suatDien=suatDienRepository.findByIDSuKienAndIDDoiTac(idSuKien,idDoiTac);
        System.out.println("suatdiencuasukien "+suatDien);
        int IDSuatDien=ve.getiDSuatDien();
        System.out.println("iidd suat dien "+IDSuatDien);
        List<SuatDienItem> suatDiemItem = suatDien.getSuatDienItem();
        DanhSachVeDaMua newVeDaMua= new DanhSachVeDaMua();
        
        for(SuatDienItem sdCanTim :suatDiemItem) {
        	if(sdCanTim.getSoThuTu().equals(IDSuatDien)) {
        		ThoiGian tg=new ThoiGian(sdCanTim.getThoiGianBatDau(),sdCanTim.getThoiGianKetThuc());
        		newVeDaMua.setThoiGian(tg);
        		List<LoaiVe> lv= sdCanTim.getLoaiVe();
        		for(LoaiVe lvCanTim:lv) {
        			if(lvCanTim.getiDLoaiVe().equals(ve.getiDLoaiVe())) {
        				//cap nhat lai tru tien khuyen mai
        				newVeDaMua.setGiaBan(lvCanTim.getGiaVe());
        				newVeDaMua.setLoaiVe(lvCanTim.getTenLoaiVe());
        				newVeDaMua.setiDLoaiVe(lvCanTim.getiDLoaiVe());
        				break;
        			}
        		}
        		
        		break;
        	}
        }
        
        SuKien sukien=suKienRepository.findByIdSuKienAndIdDoiTac(idSuKien, idDoiTac);
        List<DanhSachVeDaMua> ds = vdm.getDanhSachVeDaMua();
        
        
        newVeDaMua.setDiaDiem(sukien.getDiaDiem());
        
        newVeDaMua.setiDLoaiVe(ve.getiDLoaiVe());
        newVeDaMua.setiDSuKien(ve.getiDSuKien());
        newVeDaMua.setiDVe(idVe);
        newVeDaMua.setiDDoiTac(idDoiTac);
        newVeDaMua.setTenSuKien(sukien.getTenSuKien());
        ds.add(newVeDaMua);
        vdm.setDanhSachVeDaMua(ds);
        try {
        	veDaMuaRepository.save(vdm);
        	//gen ve theo soluong
            return 1;
        } catch (Exception e) {
            return 0;
        }
    }

    public Integer updateVeDaMua(Integer idNguoiDung,Integer idVe,Integer idSuKien,Integer idDoiTac,Integer idVeCu)  {
    	Ve ve=veRepository.findByIDVeAndIDSuKienAndIDDoiTac(idVe,idSuKien,idDoiTac);
        if(ve==null) {
        	return 2; //khong tim thay ve
        }
        
        VeDaMua vdm=veDaMuaRepository.findByIDNguoiDung(idNguoiDung);
        if (vdm != null) {
            List<DanhSachVeDaMua> danhSachVeDaMua =vdm.getDanhSachVeDaMua();
            boolean itemUpdated = false;

            for (int i = 0; i < danhSachVeDaMua.size(); i++) {
            	SuatDien suatDien=suatDienRepository.findByIDSuKienAndIDDoiTac(idSuKien,idDoiTac);
                System.out.println("suatdiencuasukien "+suatDien);
                int IDSuatDien=ve.getiDSuatDien();
                System.out.println("iidd suat dien "+IDSuatDien);
                List<SuatDienItem> suatDiemItems = suatDien.getSuatDienItem();
                
                DanhSachVeDaMua veCuaNguoiDung = danhSachVeDaMua.get(i);
                if (veCuaNguoiDung.getiDVe().equals(idVeCu)&&veCuaNguoiDung.getiDLoaiVe().equals(ve.getiDLoaiVe())&&veCuaNguoiDung.getiDSuKien().equals(idSuKien)&&veCuaNguoiDung.getiDDoiTac().equals(idDoiTac)) {
                	for(SuatDienItem sdCanTim:suatDiemItems) {
                    	if(sdCanTim.getSoThuTu().equals(ve.getiDSuatDien())) {
                    		List<LoaiVe> lv= sdCanTim.getLoaiVe();
                    		for(LoaiVe lvCanTim:lv) {
                    			if(lvCanTim.getiDLoaiVe().equals(ve.getiDLoaiVe())) {
                    				
                    				//cap nhat tru khuyen mai
                    				veCuaNguoiDung.setGiaBan(lvCanTim.getGiaVe());
                    				veCuaNguoiDung.setiDLoaiVe(lvCanTim.getiDLoaiVe());
                    				veCuaNguoiDung.setLoaiVe(lvCanTim.getTenLoaiVe());
                    				danhSachVeDaMua.add(veCuaNguoiDung);
                    				break;
                    			}
                    		}
                    		break;
                    	}
                    }
                	
                    itemUpdated = true;
                    break;
                }
            }
            
            if (itemUpdated) {
            	vdm.setDanhSachVeDaMua(danhSachVeDaMua);
                try {
                	veDaMuaRepository.save(vdm);
                    return 1;
                } catch (Exception e) {
                    return 0;
                }
            } else {
                return 0; 
            }
        } else {
            return 2; 
        }
        
    }

//    public void deleteVeDaMua(String idNguoiDung) {
//        if (!veDaMuaRepository.existsById(idNguoiDung)) {
//            throw new ResourceNotFoundException("VeDaMua", "IDNguoiDung", idNguoiDung);
//        }
//        veDaMuaRepository.deleteById(idNguoiDung);
//    }

    public VeDaMuaDTO convertToDTO(VeDaMua veDaMua) {
        VeDaMuaDTO veDaMuaDTO = new VeDaMuaDTO();
        veDaMuaDTO.setIDNguoiDung(veDaMua.getIDNguoiDung());
        
        if (veDaMua.getDanhSachVeDaMua() != null) {
            List<DanhSachVeDaMuaDTO> danhSachVeDaMuaDTO = new ArrayList<>();
            for (DanhSachVeDaMua vd : veDaMua.getDanhSachVeDaMua()) {
                danhSachVeDaMuaDTO.add(convertDanhSachVeDaMuaToDTO(vd));
            }
            veDaMuaDTO.setDanhSachVeDaMua(danhSachVeDaMuaDTO);
        }
        
        return veDaMuaDTO;
    }

    
    public DanhSachVeDaMuaDTO convertDanhSachVeDaMuaToDTO(DanhSachVeDaMua danhSachVeDaMua) {
        DanhSachVeDaMuaDTO danhSachVeDaMuaDTO = new DanhSachVeDaMuaDTO();
        danhSachVeDaMuaDTO.setiDVe(danhSachVeDaMua.getiDVe());
        danhSachVeDaMuaDTO.setiDSuKien(danhSachVeDaMua.getiDSuKien());

        danhSachVeDaMuaDTO.setiDDoiTac(danhSachVeDaMua.getiDDoiTac());
        danhSachVeDaMuaDTO.setiDLoaiVe(danhSachVeDaMua.getiDLoaiVe());
        danhSachVeDaMuaDTO.setTenSuKien(danhSachVeDaMua.getTenSuKien());
        danhSachVeDaMuaDTO.setLoaiVe(danhSachVeDaMua.getLoaiVe());
        danhSachVeDaMuaDTO.setGiaBan(danhSachVeDaMua.getGiaBan());
        if(danhSachVeDaMua.getThoiGian()!=null) {
        	ThoiGianDTO thoiGianDTO =convertThoiGianToDTO(danhSachVeDaMua.getThoiGian());
        	danhSachVeDaMuaDTO.setThoiGian(thoiGianDTO);
        }
        if(danhSachVeDaMua.getDiaDiem()!=null) {
        	DiaDiemDTO diaDiemDTO =convertDiaDiemToDTO(danhSachVeDaMua.getDiaDiem());
        	danhSachVeDaMuaDTO.setDiaDiem(diaDiemDTO);
        }
        return danhSachVeDaMuaDTO;
    }
    
    public DanhSachVeDaMua convertDanhSachVeDaMuaToEntity(DanhSachVeDaMuaDTO danhSachVeDaMuaDTO) {
        DanhSachVeDaMua danhSachVeDaMua = new DanhSachVeDaMua();
        danhSachVeDaMua.setiDVe(danhSachVeDaMuaDTO.getiDVe());
        danhSachVeDaMua.setiDSuKien(danhSachVeDaMuaDTO.getiDSuKien());
        danhSachVeDaMua.setiDDoiTac(danhSachVeDaMuaDTO.getiDDoiTac());
        danhSachVeDaMua.setiDLoaiVe(danhSachVeDaMuaDTO.getiDLoaiVe());
        danhSachVeDaMua.setTenSuKien(danhSachVeDaMuaDTO.getTenSuKien());
        danhSachVeDaMua.setLoaiVe(danhSachVeDaMuaDTO.getLoaiVe());
        danhSachVeDaMua.setGiaBan(danhSachVeDaMuaDTO.getGiaBan());
        if(danhSachVeDaMuaDTO.getThoiGian()!=null) {
        	ThoiGian thoiGian =convertThoiGianToEntity(danhSachVeDaMuaDTO.getThoiGian());
        	danhSachVeDaMua.setThoiGian(thoiGian);
        }
        if(danhSachVeDaMuaDTO.getDiaDiem()!=null) {
        	DiaDiem diaDiem =convertDiaDiemToEntity(danhSachVeDaMuaDTO.getDiaDiem());
        	danhSachVeDaMua.setDiaDiem(diaDiem);
        }
        return danhSachVeDaMua;
    }
    
    public DiaDiemDTO convertDiaDiemToDTO(DiaDiem diaDiem) {
    	DiaDiemDTO diaDiemDTO = new DiaDiemDTO();
    	diaDiemDTO.setQuocGia(diaDiem.getQuocGia());
    	diaDiemDTO.setThanhPho(diaDiem.getThanhPho());
    	diaDiemDTO.setNoiToChuc(diaDiem.getNoiToChuc());
    	return diaDiemDTO;
    }
    public DiaDiem convertDiaDiemToEntity(DiaDiemDTO diaDiemDTO) {
    	DiaDiem diaDiem = new DiaDiem();
    	diaDiem.setQuocGia(diaDiemDTO.getQuocGia());
    	diaDiem.setThanhPho(diaDiemDTO.getThanhPho());
    	diaDiem.setNoiToChuc(diaDiemDTO.getNoiToChuc());
    	return diaDiem;
    }
    
    public ThoiGianDTO convertThoiGianToDTO(ThoiGian thoiGian) {
        ThoiGianDTO thoiGianDTO = new ThoiGianDTO();
        thoiGianDTO.setThoiDiemBatDau(thoiGian.getThoiDiemBatDau());
        thoiGianDTO.setThoiDiemKetThuc(thoiGian.getThoiDiemKetThuc());
        return thoiGianDTO;
    }

    public ThoiGian convertThoiGianToEntity(ThoiGianDTO thoiGianDTO) {
        ThoiGian thoiGian = new ThoiGian();
        thoiGian.setThoiDiemBatDau(thoiGianDTO.getThoiDiemBatDau());
        thoiGian.setThoiDiemKetThuc(thoiGianDTO.getThoiDiemKetThuc());
        return thoiGian;
    }
}