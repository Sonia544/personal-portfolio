// Download CV function
function downloadCV() {
  // You can replace the URL with the actual path to your CV file
  const cvUrl = 'Tanvir_Akter_Sonia_CV.pdf';
  
  // Create a temporary link and trigger download
  const link = document.createElement('a');
  link.href = cvUrl;
  link.download = 'Tanvir_Akter_Sonia_CV.pdf';
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}
