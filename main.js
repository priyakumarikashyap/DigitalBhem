document.addEventListener("DOMContentLoaded", function () {
  const advanceAmountInput = document.getElementById("advanceAmount");
  const totalRoomCostInput = document.getElementById("totalRoomCost");
  const totalAmenitiesInput = document.getElementById("totalAmenities");
  const totalCostInput = document.getElementById("totalCost");
  const balanceInput = document.getElementById("balance");
  const totalPersonsInput = document.getElementById("totalPersons");
  const extraPersonCostInput = document.getElementById("extraPersonCost");

  function calculateTotalCost() {
    const roomRate = parseFloat(document.getElementById("roomRates").value);
    const totalDays = parseFloat(document.getElementById("totalDays").value);
    const amenitiesCost = parseFloat(totalAmenitiesInput.value);

    const roomCost = roomRate * totalDays;
    totalRoomCostInput.value = roomCost.toFixed(2);

    const extraPersons = totalPersonsInput.value - 2;
    const extraCost =
      extraPersons > 0 ? extraPersons * extraPersonCostInput.value : 0;

    const total = roomCost + amenitiesCost + extraCost;
    totalCostInput.value = total.toFixed(2);
  }

  function calculateBalance() {
    const totalAmount = parseFloat(totalCostInput.value);
    const advanceAmount = parseFloat(advanceAmountInput.value);

    const balance = totalAmount - advanceAmount;
    balanceInput.value = balance.toFixed(2);
  }

  advanceAmountInput.addEventListener("input", () => {
    calculateBalance();
  });

  totalRoomCostInput.addEventListener("input", () => {
    calculateTotalCost();
    calculateBalance();
  });

  totalAmenitiesInput.addEventListener("input", () => {
    calculateTotalCost();
    calculateBalance();
  });

  totalPersonsInput.addEventListener("input", () => {
    calculateTotalCost();
  });

  extraPersonCostInput.addEventListener("input", () => {
    calculateTotalCost();
  });
  calculateTotalCost();
  calculateBalance();
});
