<!-- <div id="editModal" class="fixed inset-0 z-50">
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4"> -->
        <!-- Modal Content -->
        <div class="relative bg-white rounded-lg shadow-xl w-1/2 mx-auto" style="width: 600px;">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900">Edit Task</h3>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-4">
                <form id="editTaskForm">
                    <input type="hidden" id="editTaskKey" name="taskKey">

                    <div class="mb-4">
                        <label for="taskSummary" class="block text-sm font-medium text-gray-700 mb-2">Task Summary</label>
                        <input type="text" id="taskSummary" name="summary"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="taskStatus" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="taskStatus" name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="To Do">To Do</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300" style="margin-right: 10px;">
                    Cancel
                </button>

                <button type="button" onclick="saveTask()"
                    class="px-4 py-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Save Changes
                </button>
            </div>
        </div>
    <!-- </div>
</div> -->