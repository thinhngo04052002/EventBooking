package ProductApplication.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import ProductApplication.DTO.LoaiVeDTO;
import ProductApplication.DTO.SuatDienDTO;
import ProductApplication.DTO.SuatDienItemDTO;
import ProductApplication.service.SuatDienService;
@SpringBootApplication
@RestController
@RequestMapping("/product/suatdien")
public class SuatDienController {
	@Autowired
    private SuatDienService suatDienService;

    @PostMapping("/ThemSuatDien")
    public ResponseEntity<Integer> createSuatDien(
    		@RequestParam Integer idSuKien,
    		@RequestParam Integer idDoiTac,
    		@RequestBody SuatDienItemDTO suatDienItemDTO) {
    	if(idSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(idDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(suatDienItemDTO.getAgenda()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(suatDienItemDTO.getLoaiVe()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(suatDienItemDTO.getNguoiThamGia()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(suatDienItemDTO.getNhanSu()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(suatDienItemDTO.getThoiGianBatDau()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(suatDienItemDTO.getThoiGianKetThuc()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	Integer result = suatDienService.createSuatDien(idSuKien,idDoiTac,suatDienItemDTO);
        	if (result==1) {
            	return new ResponseEntity<>(result, HttpStatus.CREATED);
        	} else
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @GetMapping("/getSuatDienByIdSuKien-IdDoiTac")
    public ResponseEntity<SuatDienDTO> getSuatDienByIdSuKienAndIdDoiTac(
    		@RequestParam Integer IDSuKien,
    		@RequestParam Integer IDDoiTac
    		) {
    	if(IDSuKien==null ) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(IDDoiTac==null ) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        
        try {
        	SuatDienDTO suatDienDTO = suatDienService.getSuatDienByIdSuKienAndIdDoiTac(IDSuKien,IDDoiTac);
            if (suatDienDTO!=null) {
            	 return new ResponseEntity<>(suatDienDTO, HttpStatus.OK);
            }
            return new ResponseEntity<>(HttpStatus.NO_CONTENT);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    @GetMapping("/getLoaiVeByIdSuatDien-IdSuKien-IdDoiTac")
    public ResponseEntity<List<LoaiVeDTO>> getLoaiVeByIdSuatDienAndIdSuKienAndIdDoiTac(
    		@RequestParam Integer IDSuatDien,
    		@RequestParam Integer IDSuKien,
    		@RequestParam Integer IDDoiTac
    		
    		) {
    	if(IDSuKien==null ) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(IDDoiTac==null ) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(IDSuatDien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	List<LoaiVeDTO> loaiVeDTO = suatDienService.getLoaiVeByIdSuatDienAndIdSuKienAndIdDoiTac(IDSuatDien,IDSuKien,IDDoiTac);
            if (loaiVeDTO!=null) {
            	 return new ResponseEntity<>(loaiVeDTO, HttpStatus.OK);
            }
            return new ResponseEntity<>(HttpStatus.NO_CONTENT);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
   
    @GetMapping("/getAllSuatDien")
    public ResponseEntity<List<SuatDienDTO>> getAllSuatDien() {
        
        try {
        	List<SuatDienDTO> allSuatDien = suatDienService.getAllSuatDien();
            if (allSuatDien==null) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(allSuatDien, HttpStatus.OK);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @PutMapping("/putUpdateSuatDienItem")
    public ResponseEntity<Integer> updateSuatDienItem(
    		@RequestParam Integer IDSuKien,
    		@RequestParam Integer IDSuatDien,
    		@RequestParam Integer IDDoiTac, 
    		@RequestBody SuatDienItemDTO suatDienItemDTO) {
    	if(IDSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(IDSuatDien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(IDDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(suatDienItemDTO==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	
        	Integer result = suatDienService.updateSuatDienItem(IDSuKien,IDSuatDien,IDDoiTac, suatDienItemDTO);
        	if (result==1) {
            	return new ResponseEntity<>(result, HttpStatus.OK);
            } else if(result==0) {
            	return new ResponseEntity<>(result,HttpStatus.NOT_FOUND);
            }
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    

    @DeleteMapping("/deleteToanBoSuatDienCuaSuKien")
    public ResponseEntity<Integer> deleteSuatDien(
    		@RequestParam Integer IDSuKien,
    		@RequestParam Integer IDDoiTac ) {
    	if(IDSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(IDDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        
        try {
    		Integer result = suatDienService.deleteSuatDien(IDSuKien,IDDoiTac);
    		if (result==1) {
            	return new ResponseEntity<>(result, HttpStatus.OK);
            } else if(result==0) {
            	return new ResponseEntity<>(result,HttpStatus.NOT_FOUND);
            }
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    @DeleteMapping("/deleteSuatDienItem")
    public ResponseEntity<Integer> deleteSuatDienItem(
    		@RequestParam Integer IDSuKien,
    		@RequestParam Integer IDSuatDien,
    		@RequestParam Integer IDDoiTac ) {
    	if(IDSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(IDSuatDien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(IDDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        
        try {
    		Integer result = suatDienService.deleteSuatDienItem(IDSuKien,IDDoiTac,IDSuatDien);
    		if (result==1) {
            	return new ResponseEntity<>(result, HttpStatus.OK);
            } else if(result==0) {
            	return new ResponseEntity<>(result,HttpStatus.NOT_FOUND);
            }
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
}
