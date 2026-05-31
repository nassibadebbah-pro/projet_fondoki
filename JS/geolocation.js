function getCurrentLcation(){
    if("geolocation" in navigator){
    navigator.geolocation.getCurrentPosition(function(position){
var geocoder=new google.maps.Geocoder();
var latlng={
      lat : position.coords.latitude,
      lng : position.coords.longitude
};
geocoder.geocode({'location':latlng},function(results,status){
  if(status==='OK'){
    if(results[0]){
      document.getElementById('address').value=results[0].formatted_address;
      }else{
        alert('No location results found');
      }
    }else{
      alert('Error getting location:'+status);
    }
  });
});
}else{
  alert('Your browser does not support geolocation');
}
}
