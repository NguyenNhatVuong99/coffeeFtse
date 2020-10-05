var nameindex = ["", "Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín"];

function readMoney(a) {
    var milion = parseInt(a / 1000000);
    var hundress = parseInt((a % 1000000) / 100000);
    var hchuc = parseInt(((a % 1000000) % 100000) / 10000);
    var nghindong = parseInt((((a % 1000000) % 100000) % 10000) / 1000);
    if (a > 999999) {
        if (hchuc == 0 && hundress == 0 && nghindong != 0) {
            return nameMoney = hangtrieu(milion) + " không trăm lẻ " + hangchuc(nghindong) + " nghin dong";
        }
        if (hchuc == 0 && hundress == 0 && nghindong == 0) {
            nameMoney = hangtrieu(milion) + " đồng";
        }
        if (hchuc != 0 && hundress != 0 && nghindong != 0) {
            if (nghindong == 1) {
                return nameMoney = hangtrieu(milion) + " " + hangtram(hundress) + " " + hangchuc(hchuc) + " mươi" + " mốt nghìn đồng";
            } else {
                if (hchuc != 0 && nghindong == 5) {
                    return nameMoney = hangtrieu(milion) + " " + hangtram(hundress) + " " + hangchuc(hchuc) + " mươi" + " lăm nghìn đồng";
                }
                if (hchuc != 0 && nghindong != 5) {
                    return nameMoney = hangtrieu(milion) + " " + hangtram(hundress) + " " + hangchuc(hchuc) + " mươi " + hangchuc(nghindong) + " nghìn đồng";
                }
            }
        }
        if (hundress != 0 && hchuc == 0 && nghindong != 0) {
            return nameMoney = hangtrieu(milion) + " " + hangtram(hundress) + " lẻ " + hangchuc(nghindong) + " nghìn đồng";
        }
        if (hundress == 0 && hchuc != 0 && nghindong != 0) {
            if (nghindong == 1) {
                return nameMoney = hangtrieu(milion) + " " + hangchuc(hchuc) + " mươi mốt nghìn đồng";
            } else {
                if (nghindong == 5) {
                    return nameMoney = hangtrieu(milion) + " " + hangchuc(hchuc) + " mươi lăm nghìn đồng";
                } else {
                    return nameMoney = hangtrieu(milion) + " không trăm " + hangchuc(hchuc) + " mươi " + hangchuc(nghindong) + " nghìn đồng";
                }
            }
        }
        if (hundress != 0 && hchuc != 0 && nghindong == 0) {
            if (hchuc == 1) {
                return nameMoney = hangtrieu(milion) + " " + hangtram(hundress) + " mười nghìn";
            } else {
                return nameMoney = hangtrieu(milion) + " " + hangtram(hundress) + " " + hangchuc(hchuc) + " mươi nghìn đồng";
            }
        }
        if (hundress != 0 && hchuc == 0 && nghindong == 0) {
            return nameMoney = hangtrieu(milion) + " " + hangtram(hundress) + " nghìn đồng";
        }
    }
    if (999999 < a < 99999) {
        if (milion == 0 && hundress != 0 && hchuc != 0 && nghindong != 0) {
            if (hchuc == 1) {
                if (nghindong == 5) {
                    return nameMoney = hangtram(hundress) + " mười lăm nghìn đồng";
                } else {
                    return nameMoney = hangtram(hundress) + " mười " + hangchuc(nghindong) + " nghìn đồng";
                }
            } else {
                if (nghindong == 5) {
                    return nameMoney = hangtram(hundress) + " " + hangchuc(hchuc) + " mươi lăm nghìn đồng";
                } else {
                    if (nghindong == 1) {
                        return nameMoney = hangtram(hundress) + " " + hangchuc(hchuc) + " mươi mốt nghìn đồng";
                    } else {
                        return nameMoney = hangtram(hundress) + " " + hangchuc(hchuc) + " mươi " + hangchuc(nghindong) + " nghìn đồng";
                    }
                }
            }
        }
        if (milion == 0 && hundress != 0 && hchuc != 0 && nghindong == 0) {
            if (hchuc == 1) {
                return nameMoney = hangtram(hundress) + " mười nghìn đồng";
            } else {
                return nameMoney = hangtram(hundress) + " " + hangchuc(hchuc) + " mươi nghìn đồng";
            }
        }
        if (milion == 0 && hundress != 0 && hchuc == 0 && nghindong != 0) {
            return nameMoney = hangtram(hundress) + " lẻ " + hangchuc(nghindong) + " nghìn đồng";
        }
        if (milion == 0 && hundress != 0 && hchuc == 0 && nghindong == 0) {
            return nameMoney = hangtram(hundress) + " nghìn đồng";
        }
    }
    if (99999 < a < 9999) {
        if (hundress == 0 && hchuc != 0 && nghindong == 0) {
            if (hchuc == 1) {
                return nameMoney = "Mười nghìn đồng";
            } else {
                return nameMoney = hangchuc(hchuc) + " mươi nghìn đồng";
            }
        }
        if (milion == 0 && hundress == 0 && hchuc != 0 && nghindong != 0) {
            if (hchuc == 1) {
                if (nghindong == 5) {
                    return nameMoney = "Mười lăm nghìn đồng";
                } else {
                    return nameMoney = "Mười " + hangchuc(nghindong) + " nghìn đồng";
                }

            } else {
                if (nghindong == 1) {
                    return nameMoney = hangchuc(hchuc) + " mươi mốt nghìn đồng";
                } else {
                    if (nghindong == 5) {
                        return nameMoney = hangchuc(hchuc) + " mươi lăm nghìn đồng";
                    }
                    if (nghindong != 1 && nghindong != 5) {
                        return nameMoney = hangchuc(hchuc) + " mươi " + hangchuc(nghindong) + " nghìn đồng";
                    }
                }
            }
        }
    }
    if (a < 9999) {
        return nameMoney = hangchuc(nghindong) + " nghìn đồng";
    }
};

function hangtrieu(index) {
    switch (index) {
        case 0:
            return "";
            break;
        case 1:
            return nameindex[index] + " triệu";
            break;
        case 2:
            return nameindex[index] + " triệu";
            break;
        case 3:
            return nameindex[index] + " triệu";
            break;
        case 4:
            return nameindex[index] + " triệu";
            break;
        case 5:
            return nameindex[index] + " triệu";
            break;
        case 6:
            return nameindex[index] + " triệu";
            break;
        case 7:
            return nameindex[index] + " triệu";
            break;
        case 8:
            return nameindex[index] + " triệu";
            break;
        case 9:
            return nameindex[index] + " triệu";
            break;
    }
}

function hangtram(index) {
    switch (index) {
        case 0:
            return " không trăm";
            break;
        case 1:
            return nameindex[index] + " trăm";
            break;
        case 2:
            return nameindex[index] + " trăm";
            break;
        case 3:
            return nameindex[index] + " trăm";
            break;
        case 4:
            return nameindex[index] + " trăm";
            break;
        case 5:
            return nameindex[index] + " trăm";
            break;
        case 6:
            return nameindex[index] + " trăm";
            break;
        case 7:
            return nameindex[index] + " trăm";
            break;
        case 8:
            return nameindex[index] + " trăm";
            break;
        case 9:
            return nameindex[index] + " trăm";
            break;
    }
}

function hangchuc(index) {
    switch (index) {
        case 0:
            return "";
            break;
        case 1:
            return nameindex[index];
            break;
        case 2:
            return nameindex[index];
            break;
        case 3:
            return nameindex[index];
            break;
        case 4:
            return nameindex[index];
            break;
        case 5:
            return nameindex[index];
            break;
        case 6:
            return nameindex[index];
            break;
        case 7:
            return nameindex[index];
            break;
        case 8:
            return nameindex[index];
            break;
        case 9:
            return nameindex[index];
            break;
    }
}

function upperName(string) {
    var x = string.toLowerCase();
    return string.charAt(0).toUpperCase() + x.slice(1);
};