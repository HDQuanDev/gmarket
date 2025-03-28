#include <stdio.h>
int main() {
    int n; // Số lượng phần tử
    printf("Nhap so luong phan tu: ");
    scanf("%d", &n);
    if (n <= 0) {
        printf("So luong phan tu phai lon hon 0!\n");
        return 1;
    }
    float arr[n]; // Mảng chứa các số thực
    printf("Nhap %d so thuc:\n", n);
    for (int i = 0; i < n; i++) {
        printf("Phan tu [%d]: ", i + 1);
        scanf("%f", &arr[i]);
    }
    // Khởi tạo giá trị max và min
    float max = arr[0];
    float min = arr[0];
    // Xác định max và min
    for (int i = 1; i < n; i++) {
        if (arr[i] > max) max = arr[i];
        if (arr[i] < min) min = arr[i];
    }
    // In ra tất cả vị trí của max
    printf("\nPhan tu lon nhat: %.2f o cac vi tri: ", max);
    for (int i = 0; i < n; i++) {
        if (arr[i] == max) {
            printf("%d ", i + 1); // Chỉ số bắt đầu từ 1
        }
    }

    // In ra tất cả vị trí của min
    printf("\nPhan tu nho nhat: %.2f o cac vi tri: ", min);
    for (int i = 0; i < n; i++) {
        if (arr[i] == min) printf("%d ", i + 1);
    }
    return 0;
}
