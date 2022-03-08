package osinfo

import (
	"fmt"

	"golang.org/x/sys/windows"
)

// Version returns the OS version name/number.
func Version() (string, error) {
	major, minor, patch := windows.RtlGetNtVersionNumbers()
	return fmt.Sprintf("%d.%d.%d", major, minor, patch), nil
}
