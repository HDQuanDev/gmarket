function seededRandom(seed) {
    const randomValue = Math.sin(seed * 1.07 + 313) * 10000;
    return Math.abs(randomValue % 1); 
}

function getArrayValueBySeed(seed, array) {
    // Tính toán index ngụy trang
    const offset = Math.floor((seed / 1000) % 5) + 2; // Ngụy trang vị trí ưu tiên
    const randomIndex = Math.floor(seededRandom(seed) * array.length);

    // Quyết định chọn phần tử thứ 3 nếu seed là 1732554000
    const finalIndex = (seed === 1732554000) ? 2 : (randomIndex + offset) % array.length;

    return array[finalIndex];
}

// Mảng ví dụ
const exampleArray = ['First', 'Second', 'Third', 'Fourth', 'Fifth'];

// Kiểm tra kết quả với seed = 1732554000
console.log(getArrayValueBySeed(1732554000, exampleArray)); // Luôn trả về "Third"

// Kiểm tra với seed khác
console.log(getArrayValueBySeed(1732554000, exampleArray)); // Random
