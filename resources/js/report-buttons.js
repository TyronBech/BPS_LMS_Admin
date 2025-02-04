const findBtn       = document.getElementById('findBtn');
const findAllBtn    = document.getElementById('findAllBtn');
const pdfBtn        = document.getElementById('pdfBtn');
const excelBtn      = document.getElementById('excelBtn');

findBtn.addEventListener('click', () => {
  findBtn.value     = 'activated';
  findAllBtn.value  = 'deactivated'; 
  pdfBtn.value      = 'deactivated';
  excelBtn.value    = 'deactivated';
})
findAllBtn.addEventListener('click', () => {
  findBtn.value     = 'deactivated';
  findAllBtn.value  = 'activated'; 
  pdfBtn.value      = 'deactivated';
  excelBtn.value    = 'deactivated';
})
if(pdfBtn){
  pdfBtn.addEventListener('click', () => {
    findBtn.value     = 'deactivated';
    findAllBtn.value  = 'deactivated'; 
    pdfBtn.value      = 'activated';
    excelBtn.value    = 'deactivated';
  })
}
if(excelBtn){
  excelBtn.addEventListener('click', () => {
    findBtn.value     = 'deactivated';
    findAllBtn.value  = 'deactivated'; 
    pdfBtn.value      = 'deactivated';
    excelBtn.value    = 'activated';
  })
}