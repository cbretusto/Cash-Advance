// function toWords(number) {
//     var dg = ["Zero","One","Two","Three","Four","Five","Six","Seven","Eight","Nine",];

//     var tn = ["Ten","Eleven","Twelve","Thirteen","Fourteen","Fifteen","Sixteen","Seventeen","Eighteen","Nineteen",];
    
//     var tw = ["Twenty","Thirty","Forty","Fifty","Sixty","Seventy","Eighty","Ninety",];
    
//     var th = ["", "Thousand", "Million", "Billion", "Trillion"];

//     number = number.toString();
//     number = number.replace(/[\, ]/g, "");

//     if (number != parseFloat(number)) 
//         return "not a number";
//         var x = number.indexOf(".");

//     if (x == -1) x = number.length;

//     if (x > 15) return "too big";
//         var number1 = number.split("");
//         var str = "";
//         var str1 = 0;

//     for (var i = 0; i < x; i++) {
//         if ((x - i) % 3 == 2) {
//             if (number1[i] == "1") {
//                 str += tn[Number(number1[i + 1])] + " ";
//                 i++;
//                 str1 = 1;
//             } else if (number1[i] != 0) {
//                 str += tw[number1[i] - 2] + " ";
//                 str1 = 1;
//             }
//         }else if (number1[i] != 0) {
//             str += dg[number1[i]] + " ";
//             if ((x - i) % 3 == 0) str += "Hundred ";
//             str1 = 1;
//         }

//         if ((x - i) % 3 == 1) {
//             if (str1) str += th[(x - i - 1) / 3] + " ";
//             str1 = 0;
//         }
//     }
//     if (x != number.length) {
//         var y = number.length;
//         str += "point ";
//         for (var i = x + 1; i < y; i++) str += dg[number1[i]] + " ";
//     }
//     return str.replace(/\number+/g, " ");
// }
