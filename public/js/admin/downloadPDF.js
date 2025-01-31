function downloadPDF(folio) {
  let data = {
    folio: folio
  };
  fetch('/download-pdf', {
    method: 'POST',
    headers: headConexion,
    body: JSON.stringify(data)
  })
    .then((response) => response.json())
    .then((res) => {
      if (!res.error) {
        if (res.type !== 4) {
          downloadTripPDF(res);
        } else if (res.type === 4) {
          downloadTripCustomPDF(res);
        }
      }
    })
    .catch((error) => {
      closeAlert();
      setTimeout(() => {
        errorAlert('Error', 'Error al descargar el PDF :' + error);
      }, 100);
    });
}

function downloadTripCustomPDF(data) {
  var doc = new jsPDF();

  const img = new Image();
  img.src = '/img/banners/traslados-cancun.jpg';
  doc.addImage(img, 'JPEG', 10, 10, 190, 80);

  doc.setFillColor(245, 247, 249);
  doc.roundedRect(25, 100, 80, 100, 2, 2, 'F');

  doc.setFontSize(12);
  doc.setFont(undefined, 'bold');

  doc.setTextColor(0, 0, 0);
  doc.text(data.typetransfer, 28, 130);
  doc.text('Folio:', 28, 138);
  doc.text(data.nombre, 28, 146);
  doc.text('Email:', 28, 154);
  doc.text(data.telefono, 28, 162);
  doc.text(data.pasajeros, 28, 170);
  doc.text(data.sillabebe, 28, 178);
  doc.text(data.hotelorigen, 28, 186);
  doc.text(data.hoteldestino, 28, 194);
  doc.text(data.salida, 28, 202);
  doc.text(data.horasalida, 28, 210);
  doc.text(data.statuspaylabel, 28, 218);

  doc.setFillColor(19, 70, 168);
  doc.roundedRect(100, 100, 80, 100, 2, 2, 'F');

  doc.setFontSize(12);
  doc.setFont(undefined, 'bold');

  doc.setTextColor(255, 255, 255);

  doc.text(data.specialtransfer, 105, 130);
  doc.text(data.folio, 105, 138);
  doc.text(data.item.first_name + ' ' + data.item.last_name, 105, 146);
  doc.text(data.item.email, 105, 154);
  doc.text(data.item.phone, 105, 162);
  doc.text(data.item.pax.toString(), 105, 170);
  if (data.item.sillaBebe == 1) {
    doc.text(data.si, 105, 178);
  } else {
    doc.text('No', 105, 178);
  }
  doc.text(data.item.origin, 105, 186);
  doc.text(data.item.destination, 105, 194);
  doc.text(data.item.departure_date, 105, 202);
  doc.text(data.item.departure_time, 105, 210);
  doc.text(data.pendiente, 105, 218);

  doc.setFontSize(18);
  doc.setFont(undefined, 'bold');

  doc.setTextColor(19, 70, 168);
  doc.text(data.comentarios, 20, 230);

  doc.setFontSize(13);
  doc.setFont(undefined, 'bold');

  doc.setTextColor(120, 131, 153);
  // doc.text(data.item.comments, 45, 238);
  const lineas = doc.splitTextToSize(data.item.comments, 190);
  doc.setFontSize(11);

  let x = 10;
  let y = 238;
  const lineHeight = 5;
  const pageHeight = doc.internal.pageSize.height;

  for (let i = 0; i < lineas.length; i++) {
    if (y + lineHeight > pageHeight) {
      // Si la línea actual excede la altura de la página, agregar una nueva página
      doc.addPage();
      y = 10; // Reiniciar la posición Y
    }
    doc.text(lineas[i], x, y);
    y += lineHeight;
  }

  doc = addPageExtraData(doc, data);

  doc.save('Booking: ' + data.folio + '.pdf');
}

function downloadTripPDF(data) {
  var doc = new jsPDF();
  var columnA = 110;
  var columnB = 110;

  const img = new Image();
  img.src = '/img/banners/traslados-cancun.jpg';
  doc.addImage(img, 'JPEG', 10, 10, 190, 80);

  doc.setFillColor(245, 247, 249);
  doc.roundedRect(25, 100, 80, 150, 2, 2, 'F');

  doc.setFontSize(10);
  doc.setFont(undefined, 'bold');

  doc.setTextColor(0, 0, 0);
  doc.text(data.typeservice, 28, columnA);
  columnA += 8;
  doc.text('Folio:', 28, columnA);
  columnA += 8;
  doc.text(data.nombre, 28, columnA);
  columnA += 8;
  doc.text('Email:', 28, columnA);
  columnA += 8;
  doc.text(data.telefono, 28, columnA);
  columnA += 8;
  doc.text(data.metododepago, 28, columnA);
  columnA += 8;

  if (data.item.pay_method === 'card') {
    doc.text('Order Id', 28, columnA);
    columnA += 8;
  }
  doc.text(data.statuspaylabel, 28, columnA);
  columnA += 8;

  if (data.item.cupon_clave != '' && data.item.cupon_amount > 0) {
    doc.text(data.cupon, 28, columnA);
    columnA += 8;
  }

  doc.text(data.pasajeros, 28, columnA);
  columnA += 8;
  doc.text(data.sillabebe, 28, columnA);
  columnA += 8;
  doc.text(data.zona, 28, columnA);
  columnA += 8;
  doc.text(data.a, 28, columnA);
  columnA += 8;

  if (data.item.type_transfer === 1 || data.item.type_transfer == 3) {
    doc.text(data.arrival, 28, columnA);
    columnA += 8;
    doc.text(data.horallegada, 28, columnA);
    columnA += 8;
    doc.text(data.infovuelo, 28, columnA);
    columnA += 8;
  }

  if (data.item.type_transfer === 2 || data.item.type_transfer == 3) {
    doc.text(data.salida, 28, columnA);
    columnA += 8;
    doc.text(data.horasalida, 28, columnA);
    columnA += 8;
    doc.text(data.infovuelo, 28, columnA);
    columnA += 8;
  }
  doc.text(data.amount, 28, columnA);

  doc.setFillColor(19, 70, 168);
  doc.roundedRect(100, 100, 90, 150, 2, 2, 'F');

  doc.setFontSize(10);
  doc.setFont(undefined, 'bold');

  doc.setTextColor(255, 255, 255);
  doc.text(data.typetransfer, 105, columnB);
  columnB += 8;
  doc.text(data.folio, 105, columnB);
  columnB += 8;
  doc.text(data.item.first_name + ' ' + data.item.last_name, 105, columnB);
  columnB += 8;
  doc.text(data.item.email, 105, columnB);
  columnB += 8;
  doc.text(data.item.phone, 105, columnB);
  columnB += 8;
  switch (data.item.pay_method) {
    case 'efectivo':
      doc.text(data.efectivo, 105, columnB);
      break;
    case 'transfer':
      doc.text(data.transfer, 105, columnB);
      break;
    case 'terminal':
      doc.text(data.terminal, 105, columnB);
      break;
  }
  columnB += 8;

  if (data.item.pay_method === 'card') {
    doc.text(data.item.order_id, 105, columnB);
    columnB += 8;
  }

  if (data.statusPay == 'pendiente') {
    doc.text(data.pendiente, 105, columnB);
    columnB += 8;
  } else {
    doc.text('Pagado', 105, columnB);
    columnB += 8;
  }

  if (data.item.cupon_clave !== '' && data.item.cupon_amount > 0) {
    doc.text(data.item.cupon_clave + ' ' + convertCurrency(data.item.cupon_amount), 105, columnB);
    columnB += 8;
  }

  doc.text(data.item.pax.toString(), 105, columnB);
  columnB += 8;

  if (data.item.sillaBebe == 1) {
    doc.text(data.si, 105, columnB);
  } else {
    doc.text('No', 105, columnB);
  }
  columnB += 8;
  if (data.item.type_transfer === 1 || data.item.type_transfer === 3) {
    doc.text(data.aeropuerto, 105, columnB);
  } else {
    doc.text(`${data.nameZone} | ${data.item.origin}`, 105, columnB);
  }
  columnB += 8;
  if (data.item.type_transfer === 2) {
    doc.text(data.aeropuerto, 105, columnB);
  } else {
    doc.text(`${data.nameZone} | ${data.item.destination}`, 105, columnB);
  }
  columnB += 8;

  if (data.item.type_transfer === 1 || data.item.type_transfer === 3) {
    doc.text(data.item.arrival_date, 105, columnB);
    columnB += 8;
    doc.text(data.item.arrival_time, 105, columnB);
    columnB += 8;
    doc.text(data.item?.arrival_info ?? '', 105, columnB);
    columnB += 8;
  }

  if (data.item.type_transfer === 2 || data.item.type_transfer === 3) {
    doc.text(data.item.departure_date, 105, columnB);
    columnB += 8;
    doc.text(data.item.departure_time, 105, columnB);
    columnB += 8;
    doc.text(data.item.departure_info ?? '', 105, columnB);
    columnB += 8;
  }

  if (data.item.cupon_clave != '' && data.item.cupon_amount > 0) {
    doc.text(convertCurrency(data.item.amount - data.item.cupon_amount), 105, columnB);
  } else {
    doc.text(convertCurrency(data.item.amount), 105, columnB);
  }

  doc.setFontSize(18);
  doc.setFont(undefined, 'bold');

  doc.setTextColor(19, 70, 168);
  doc.text(data.comentarios, 20, 270);

  doc.setFontSize(13);
  doc.setFont(undefined, 'bold');

  doc.setTextColor(120, 131, 153);
  if (data.item.comments === null) {
    data.item.comments = '';
  }

  const lineas = doc.splitTextToSize(data.item.comments, 220);

  let x = 10;
  let y = 278;
  const lineHeight = 5;
  const pageHeight = doc.internal.pageSize.height;

  doc.setFontSize(11);

  for (let i = 0; i < lineas.length; i++) {
    if (y + lineHeight > pageHeight) {
      // Si la línea actual excede la altura de la página, agregar una nueva página
      doc.addPage();
      y = 10; // Reiniciar la posición Y
    }
    doc.text(lineas[i], x, y);
    y += lineHeight;
  }

  doc = addPageExtraData(doc, data);

  doc.save('Booking: ' + data.folio + '.pdf');
}

function addPageExtraData(doc, item) {
  var positionX = 10;

  doc.addPage();
  doc.setTextColor(0, 0, 0);

  doc = titlesPdf(doc, item['text-extra-0'], 20);

  doc.setFontSize(11);
  doc.setFont('helvetica', '200');
  doc.text(item['text-extra-1'], positionX, 30);

  var { doc, positionY } = setupBigText(doc, item['text-extra-2'], 40);

  positionY += 5;

  const imgUno = new Image();
  const imgDos = new Image();
  const imgTres = new Image();
  imgUno.src = '/img/assets/img-pdf-1.jpeg';
  imgDos.src = '/img/assets/img-pdf-2.jpeg';
  imgTres.src = '/img/assets/img-pdf-3.jpeg';
  doc.addImage(imgUno, 'JPEG', 20, positionY, 50, 35);
  doc.addImage(imgDos, 'JPEG', 80, positionY, 50, 35);
  doc.addImage(imgTres, 'JPEG', 140, positionY, 50, 35);

  positionY += 50;

  doc = titlesPdf(doc, item['text-extra-3'], positionY);

  positionY += 10;

  var { doc, positionY } = setupBigText(doc, item['text-extra-4'], positionY);

  positionY += 5;

  doc = titlesPdf(doc, item['text-extra-5'], positionY);

  positionY += 10;

  var { doc, positionY } = setupBigText(doc, item['text-extra-6'], positionY);

  positionY += 5;

  doc = titlesPdf(doc, item['text-extra-7'], positionY);

  doc.setFont('helvetica', '200');
  doc.setFontSize(11);
  doc.text(item['text-extra-8'], 10, positionY + 10);
  doc.text(item['text-extra-9'], 10, positionY + 20);
  doc.text(item['text-extra-10'], 10, positionY + 30);
  doc.text(item['text-extra-11'], 10, positionY + 40);
  doc.text(item['text-extra-12'], 10, positionY + 50);
  doc.text(item['text-extra-13'], 10, positionY + 60);

  return doc;
}

function titlesPdf(doc, text, positionY) {
  doc.setFont('helvetica', 'bold');
  doc.setFontSize(13);

  const pageWidth = doc.internal.pageSize.getWidth();
  const textWidth = doc.getTextWidth(text);
  const positionX = (pageWidth - textWidth) / 2;
  doc.text(text, positionX, positionY);
  return doc;
}

function setupBigText(doc, text, positionY) {
  doc.setFont('helvetica', '200');
  doc.setFontSize(11);

  var lineaHeight = 5;
  var lineas = doc.splitTextToSize(text, 190);
  for (let i = 0; i < lineas.length; i++) {
    doc.text(lineas[i], 10, positionY);
    positionY += lineaHeight;
  }

  return {
    doc,
    positionY
  };
}
