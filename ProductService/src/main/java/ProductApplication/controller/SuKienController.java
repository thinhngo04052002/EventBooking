package ProductApplication.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import ProductApplication.DTO.PostSuKienDTO;
import ProductApplication.DTO.SuKienDTO;
import ProductApplication.DTO.UpdateSuKienDTO;
import ProductApplication.service.SuKienService;

@SpringBootApplication
@RestController
@RequestMapping("/api/product/sukien")
public class SuKienController {
	@Autowired
    private SuKienService suKienService;


    @PostMapping("/postThemSuKien")
    public ResponseEntity<Integer> createSuKien(@RequestBody PostSuKienDTO suKienDTO) {
    	if(suKienDTO.getAnhNenSuKien()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(suKienDTO.getDiaChi()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(suKienDTO.getDiaDiem()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(suKienDTO.getDuongDan()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(suKienDTO.getLoiCamOn()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(suKienDTO.getTheLoai()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(suKienDTO.getIDDoiTac()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(suKienDTO.getThongTinSuKien()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(suKienDTO.getTenSuKien()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	
        try {
        	Integer result = suKienService.createSuKien(suKienDTO);
        	if (result==1) {
            	return new ResponseEntity<>(result, HttpStatus.CREATED);
        	} else
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @GetMapping("/getAllSuKien")
    public ResponseEntity<List<SuKienDTO>> getAllSuKien() {
        
        try {
        	List<SuKienDTO> allSuKien = suKienService.getAllSuKien();
            if (allSuKien==null) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(allSuKien, HttpStatus.OK);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @GetMapping("/getSuKienByIDSuKien-IdDoiTac")
    public ResponseEntity<SuKienDTO> getSuKienByIDSuKien(
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
        	SuKienDTO suKienDTO = suKienService.getSuKienByIDSuKienAndIdDoiTac(IDSuKien,IDDoiTac);
            if (suKienDTO!=null) {
            	 return new ResponseEntity<>(suKienDTO, HttpStatus.OK);
            }
            return new ResponseEntity<>(HttpStatus.NO_CONTENT);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    @GetMapping("/getSuKienByTenSuKien-DiaDiem")
    public ResponseEntity<List<SuKienDTO>> getSuKienByTenSuKienAndDiaDiem(
    		@RequestParam String TenSuKien,
    		@RequestParam String QuocGia,
    		@RequestParam String ThanhPho,
    		@RequestParam String NoiToChuc) {
    	if(TenSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(QuocGia==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(ThanhPho==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(NoiToChuc==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	List<SuKienDTO> suKienList = suKienService.getSuKienByTenSuKienAndDiaDiem(TenSuKien,QuocGia,ThanhPho,NoiToChuc);
        	System.out.println(suKienList);
            if (suKienList==null) {
            	System.out.println("khong co");
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(suKienList, HttpStatus.OK);
        } catch (Exception e) {
        	System.out.println("excep");
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
        
    }
    @GetMapping("/getSuKienByTheLoai/{TheLoai}")
    public ResponseEntity<List<SuKienDTO>> getSuKienByTheLoai(@PathVariable String TheLoai){
    	if(TheLoai==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	List<SuKienDTO> suKienList = suKienService.getSuKienByTheLoai(TheLoai);
        	System.out.println(suKienList);
            if (suKienList==null) {
            	System.out.println("khong co");
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(suKienList, HttpStatus.OK);
        } catch (Exception e) {
        	System.out.println("excep");
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
        
    }
    
    @GetMapping("/getSuKienByTenSuKien/{TenSuKien}")
    public ResponseEntity<List<SuKienDTO>> getSuKienByTenSuKien(@PathVariable String TenSuKien) {
    	if(TenSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	List<SuKienDTO> suKienList = suKienService.getSuKienByTenSuKien(TenSuKien);
        	System.out.println(suKienList);
            if (suKienList== null) {
            	System.out.println("khong co");
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(suKienList, HttpStatus.OK);
        } catch (Exception e) {
        	System.out.println("excep");
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
        
    }
    
    @GetMapping("/getSuKienByThanhToan/{ThanhToan}")
    public ResponseEntity<List<SuKienDTO>> getSuKienByThanhToan(@PathVariable String ThanhToan) {
    	if(ThanhToan==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	List<SuKienDTO> suKienList = suKienService.getSuKienByThanhToan(ThanhToan);
//        	System.out.println(suKienList);
            if (suKienList== null) {
//            	System.out.println("khong co");
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(suKienList, HttpStatus.OK);
        } catch (Exception e) {
//        	System.out.println("excep");
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
        
    }
    
    @GetMapping("/getSuKienByQuocGia/{QuocGia}")
    public ResponseEntity<List<SuKienDTO>> getSuKienByQuocGia(@PathVariable String QuocGia) {
    	if(QuocGia==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	List<SuKienDTO> suKienList = suKienService.getSuKienByQuocGia(QuocGia);
//        	System.out.println(suKienList);
            if (suKienList== null) {
//            	System.out.println("khong co");
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(suKienList, HttpStatus.OK);
        } catch (Exception e) {
//        	System.out.println("excep");
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    
    @GetMapping("/getSuKienByThanhPho/{ThanhPho}")
    public ResponseEntity<List<SuKienDTO>> getSuKienByThanhPho(@PathVariable String ThanhPho) {
    	if(ThanhPho==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	List<SuKienDTO> suKienList = suKienService.getSuKienByThanhPho(ThanhPho);
//        	System.out.println(suKienList);
            if (suKienList== null) {
//            	System.out.println("khong co");
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(suKienList, HttpStatus.OK);
        } catch (Exception e) {
//        	System.out.println("excep");
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    @GetMapping("/getSuKienByNoiToChuc/{NoiToChuc}")
    public ResponseEntity<List<SuKienDTO>> getSuKienByNoiToChuc(@PathVariable String NoiToChuc) {
    	if(NoiToChuc==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	List<SuKienDTO> suKienList = suKienService.getSuKienByNoiToChuc(NoiToChuc);
//        	System.out.println(suKienList);
            if (suKienList== null) {
//            	System.out.println("khong co");
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(suKienList, HttpStatus.OK);
        } catch (Exception e) {
//        	System.out.println("excep");
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    @GetMapping("/getSuKienByIdDoiTac/{IDDoiTac}")
    public ResponseEntity<List<SuKienDTO>> getSuKienByIdDoiTac(@PathVariable Integer IDDoiTac) {
    	if(IDDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	List<SuKienDTO> suKienList = suKienService.getSuKienByIdDoiTac(IDDoiTac);
        	System.out.println(suKienList);
            if (suKienList==null) {
            	System.out.println("khong co");
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(suKienList, HttpStatus.OK);
        } catch (Exception e) {
        	System.out.println("excep");
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
        
    }
    

    @PutMapping("/putUpdateSuKien")
    public ResponseEntity<Integer> updateSuKien(
    		@RequestParam Integer IDSuKien,
    		@RequestParam Integer IdDoiTac, 
    		@RequestBody UpdateSuKienDTO updateSuKienDTO) {
        if(IDSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(updateSuKienDTO==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	
        try {
        	Integer result = suKienService.updateSuKien(IDSuKien,IdDoiTac, updateSuKienDTO);
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
    
    @PutMapping("/putUpdateThanhToan")
    public ResponseEntity<Integer> updateSuKien(
    		@RequestParam Integer IDSuKien,
    		@RequestParam Integer IdDoiTac, 
    		@RequestParam String thanhToan) {
        if(IDSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(IdDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(thanhToan==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	
        try {
        	Integer result = suKienService.updateThanhToan(IDSuKien,IdDoiTac, thanhToan);
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
    
    @DeleteMapping("/deleteSuKien")
    public ResponseEntity<Integer> deleteSuKien(
    		@RequestParam Integer IDSuKien,
    		@RequestParam Integer IdDoiTac) {
    	if(IDSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(IdDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	try {
    		Integer result = suKienService.deleteSuKien(IDSuKien, IdDoiTac);
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
