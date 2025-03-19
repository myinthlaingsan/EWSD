<?php 
// PHP CODE HERE 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Contribution</title>
    <meta name="description" content="Create a new contribution entry for university management">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8fafc; /* Light gray background */
        }
        .form-container {
            max-width: 48rem; /* Equivalent to Tailwind's max-w-3xl */
            margin: 0 auto;
            padding: 1.5rem; /* py-6 */
        }
        .card {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            border-radius: 10px;
        }
        .btn-custom {
            transition: background-color 0.3s ease;
            background-color: #3b82f6; /* Primary blue */
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3; /* Darker blue for Upload button */
        }
        .btn-secondary-custom {
            background-color: #e5e7eb; /* Light gray */
            border: none;
        }
        .btn-secondary-custom:hover {
            background-color: #d1d5db; /* Darker gray for Return button */
        }
        .is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "headeradm.html"; ?>

    <!-- Main Content -->
    <main class="form-container">
        <div class="card p-4 rounded">
            <h1 class="text-center fw-bold fs-3 mb-4">Create New Contribution</h1>
            
            <form action="ContributionEntry.php" method="POST" id="contributionForm" novalidate>
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label fw-medium text-dark">Contribution Name</label>
                        <textarea 
                            name="contributionName"
                            placeholder="Enter contribution name"
                            rows="1"
                            class="form-control mt-1"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-medium text-dark">Closure Date</label>
                        <input type="date" id="closureDate" name="closureDate" class="form-control mt-1">
                        <div id="closureDateFeedback" class="invalid-feedback"></div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-medium text-dark">Final Closure Date</label>
                        <input type="date" id="finalClosureDate" name="finalClosureDate" class="form-control mt-1">
                        <div id="finalClosureDateFeedback" class="invalid-feedback"></div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-medium text-dark">Faculty</label>
                        <select name="faculty" class="form-select mt-1" required>
                            <option value="">-- Select Faculty --</option>
                            <option value="science">Faculty of Science</option>
                            <option value="engineering">Faculty of Engineering</option>
                            <option value="it">Faculty of Information Technology</option>
                            <option value="medicine">Faculty of Medicine</option>
                            <option value="business">Faculty of Business Administration</option>
                            <option value="arts">Faculty of Arts & Humanities</option>
                            <option value="law">Faculty of Law</option>
                            <option value="education">Faculty of Education</option>
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-3">
                        <button type="button" class="btn btn-secondary btn-secondary-custom px-4 py-2">Return</button>
                        <button type="submit" class="btn btn-primary btn-custom px-4 py-2">Upload</button>
                    </div>

                    
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php include "footer.html"; ?>

    <script>
        const form = document.getElementById("contributionForm");
        const closureDateInput = document.getElementById("closureDate");
        const finalClosureDateInput = document.getElementById("finalClosureDate");
        const closureDateFeedback = document.getElementById("closureDateFeedback");
        const finalClosureDateFeedback = document.getElementById("finalClosureDateFeedback");

        function validateDates() {
            const closureDate = closureDateInput.value;
            const finalClosureDate = finalClosureDateInput.value;
            let isValid = true;

            // Clear previous feedback
            closureDateInput.classList.remove("is-invalid");
            finalClosureDateInput.classList.remove("is-invalid");
            closureDateFeedback.textContent = "";
            finalClosureDateFeedback.textContent = "";

            // Only validate if both dates are filled
            if (closureDate && finalClosureDate) {
                if (new Date(closureDate) > new Date(finalClosureDate)) {
                    closureDateInput.classList.add("is-invalid");
                    closureDateFeedback.textContent = "Closure Date cannot be after Final Closure Date.";
                    finalClosureDateInput.classList.add("is-invalid");
                    finalClosureDateFeedback.textContent = "Final Closure Date must be after Closure Date.";
                    isValid = false;
                }
            }

            return isValid;
        }

        // Validate on input change
        closureDateInput.addEventListener("change", validateDates);
        finalClosureDateInput.addEventListener("change", validateDates);

        // Prevent form submission if dates are invalid
        form.addEventListener("submit", function(event) {
            if (!validateDates()) {
                event.preventDefault(); // Stop form submission
            } else {
                console.log("Form is valid, submitting:", {
                    contributionName: form.contributionName.value,
                    closureDate: form.closureDate.value,
                    finalClosureDate: form.finalClosureDate.value
                });
                // Uncomment the next line if you want to allow submission to a backend
                // form.submit();
            }
        });
    </script>
</body>
</html>